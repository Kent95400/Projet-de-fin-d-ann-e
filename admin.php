<?php
session_start();
require_once 'param_sql.php'; /*appel du fichier parametrage*/
$objDb = new mysqli(SQL_HOST, SQL_USER, SQL_PWD, SQL_BDD); /* connection à la base de données*/
if ($objDb->connect_errno) {
    error_log('Connection error:' . $objDb->connect_error);
    exit;
}
$firstName = $_SESSION['first_name'];
$lastName = $_SESSION['last_name'];
$email = $_SESSION['email'];
$isAdmin = $_SESSION['is_admin'];
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
    <link rel="stylesheet" href="../reset.css" />
    <link rel="stylesheet" href="../style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="./JS/modale.js" defer></script>
    <script src="./JS/carousel.js" defer></script>
    <script src="./JS/panier.js" defer></script>
    <script src="./JS/script.js" defer></script>

</head>


<body>

    <?php
    include ('./Model/header.php');
    ?>

    <h3 class=" row justify-content-center mt-5">Bienvenue, <?php echo $firstName . ' ' . $lastName; ?> !</h3
        justify-content-center>



    <div class="row row-cols-1 row-cols-md-5 mt-5  mb-3 text-center justify-content-center">
        <div class="col h-50">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3">
                    <h4 class="my-0 fw-normal">Produits</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title pricing-card-title">
                        <ul class="list-unstyled mt-4 mb-4 ">
                            <li>Nouveau produit</li>
                            <li>Suppression produit</li>

                        </ul>
                    </h5>

                    <button type="button" class="w-300 btn btn-lg btn-outline-primary"><a class="text-decoration-none"
                            href="./administrateur/supp_produit.php">Gestions des produits</a></button>
                </div>
            </div>
        </div>
        <div class="col h-auto">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3">
                    <h4 class="my-0 fw-normal">Utilisateurs</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title pricing-card-title">
                        <ul class="list-unstyled mt-4 mb-1">
                            <li>Ajouts utilisateurs</li>
                            <li>Modification utilisateurs</li>
                            <li>Suppression utilisateurs</li>
                            <li>Accès administrateur</li>
                        </ul>
                    </h5>

                    <button type="button" class="w-300 btn btn-lg btn-danger"><a class="text-decoration-none text-light"
                            href="./administrateur/users.php">Gestions utilisateurs</a></button>
                </div>
            </div>
        </div>
    </div>







</body>

<?php
include ('./Model/footer.php')

    ?>