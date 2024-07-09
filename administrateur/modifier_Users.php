<?php
session_start();
require_once '../param_sql.php'; /*appel du fichier parametrage*/
$objDb = new mysqli(SQL_HOST, SQL_USER, SQL_PWD, SQL_BDD); /* connection à la base de données*/
if ($objDb->connect_errno) {
    error_log('Connection error:' . $objDb->connect_error);
    exit;
}
$loggedIn = isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : false;

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    // Redirection vers la page de connexion
    header("Location: ../page_accueil.php");
    exit;
}

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    // Redirection vers la page d'accueil
    header("Location: ../page_accueil.php");
    exit;
}



$id = "";
$firstName = "";
$lastName = "";
$email = "";
$adress = "";
$isAdmin = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Methode GET: affiché les infos utilisateur
    if (!isset($_GET['id'])) {
        header("location: users.php");
        exit;
    }
    $id = $_GET["id"];

    // lire la ligne dans la BDD de l'utilisateur selectionné
    $sql = "SELECT * FROM users WHERE id=$id";
    $sqlResult = $objDb->query($sql);
    $row = $sqlResult->fetch_assoc();

    if (!$row) {
        header("location: users.php");
        exit;
    }

    $firstName = $row["first_name"];
    $lastName = $row["last_name"];
    $email = $row["email"];
    $adress = $row["adress"];
    $isAdmin = $row["is_admin"];
} else {
    // Methode POST: Update les infos utilisateur

    $id = $_POST["id"];
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $email = $_POST["email"];
    $adress = $_POST["adress"];
    $isAdmin = isset($_POST["is_admin"]) ? 1 : 0;

    do {
        if (empty($id) || empty($firstName) || empty($lastName) || empty($email)) {
            $errorMessage = "Veuillez remplir tous les champs";
            break;
        }

        $sql = "UPDATE users SET first_name = '$firstName', last_name = '$lastName', email = '$email', adress = '$adress', is_admin = $isAdmin WHERE id = $id";
        $sqlResult = $objDb->query($sql);

        if (!$sqlResult) {
            $errorMessage = "Query invalide: " . $objDb->error;
            break;
        }
        $successMessage = "Utilisateur mis à jour correctement";

        header("location: users.php");
        exit;
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <title>Modifier utilisateur</title>
</head>

<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Modifier utilisateur</h2>
        <?php
        if (!empty($errorMessage)) {
            echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
        }
        ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <div class="row mb-3">
                <label class="text-center col-sm-3 col-form-label">Prénom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="first_name"
                        value="<?php echo htmlspecialchars($firstName); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="text-center col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="last_name"
                        value="<?php echo htmlspecialchars($lastName); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="text-center col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email"
                        value="<?php echo htmlspecialchars($email); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="text-center col-sm-3 col-form-label">Adresse</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="adress"
                        value="<?php echo htmlspecialchars($adress); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="text-center col-sm-3 col-form-label">Admin</label>
                <div class="col-sm-6">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="is_admin" id="is_admin" <?php echo $isAdmin ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="is_admin">Cocher si l'utilisateur est un
                            administrateur</label>
                    </div>
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
            ?>

            <div class="row mb-3">
                <div class="col-sm-3 offset-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a href="users.php" class="btn btn-outline-danger" role="button">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>