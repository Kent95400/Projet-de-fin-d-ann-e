<?php
session_start();
require_once 'param_sql.php'; /*appel du fichier parametrage*/
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

$firstName = $_SESSION['first_name'];
$lastName = $_SESSION['last_name'];
$email = $_SESSION['email'];
$isAdmin = $_SESSION['is_admin'];

$errorMessage = "";
$successMessage = "";
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Page d'accueil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="reset.css" />
    <link rel="stylesheet" href="style.css" />
    <script src="./JS/connexion.js" defer></script>
    <script src="./JS/carousel.js" defer></script>
    <script src="./JS/panier.js" defer></script>
    <script src="./JS/script.js" defer></script>
</head>


<?php
include ('./Model/header.php');
?>


<h1>Bienvenue, <?php echo $firstName . ' ' . $lastName; ?> !</h1>
<p>Email: <?php echo $email; ?></p>
<p>Statut: <?php echo $isAdmin ? 'Administrateur' : 'Utilisateur'; ?></p>

<?php
include ('./Model/footer.php')
    ?>