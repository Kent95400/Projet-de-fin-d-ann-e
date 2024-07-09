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
    // Redirection vers la page moncompte.php
    header("Location: ../page_accueil.php");
    exit;

}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Utilisateurs</title>
    <script src="./JS/modale.js" defer></script>

</head>


<body>
    <div class="container my-3"></div>
    <h2 class="text-center mb-4">Liste des utilisateurs</h2>
    <div class="text-center">
        <a href="creation_Users.php" class="btn btn-primary mb-4">Nouvel utilisateur</a>

        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Adress</th>
                    <th>Admin</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM users";
                $sqlResult = $objDb->query($sql);
                if (!$sqlResult) {
                    die("Query invalide:" . $objDb->error);
                }
                // Lecture des données pour chaque ligne
                while ($row = $sqlResult->fetch_assoc()) {
                    echo "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['adress']}</td>
                <td>{$row['is_admin']}</td>
                <td>
                    <a href='modifier_Users.php?id={$row['id']}' class='btn btn-primary btn-sm'>Modifier 
                    </a>
                    <a href='supp_Users.php?id={$row['id']}' class='btn btn-danger btn-sm'>Supprimer</a>
                </td>
            </tr>
        ";
                }

                ?>

                </dialog>
            </tbody>


            </tbody>
        </table>
</body>

</html>