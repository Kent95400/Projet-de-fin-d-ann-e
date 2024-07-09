<?php
session_start();
require_once 'param_sql.php'; /*appel du fichier parametrage*/
$objDb = new mysqli(SQL_HOST, SQL_USER, SQL_PWD, SQL_BDD); /* connection à la base de données*/
if ($objDb->connect_errno) {
  error_log('Connection error:' . $objDb->connect_error);
  exit;

}
// $firstName = $_SESSION['first_name'];
// $lastName = $_SESSION['last_name'];
// $email = $_SESSION['email'];
// $isAdmin = $_SESSION['is_admin'];
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

<body>

  <?php
  include ('./Model/header.php');

  ?>

  <div class="carousel-container">
    <div class="carousel-slide active">
      <video controls>
        <source src="./img/carousel/securityshield.mp4" type="video/mp4">
      </video>
    </div>
    <div class="carousel-slide">
      <img src="./img/carousel/carouselle.jpg" alt="img caméra">
    </div>
    <div class="carousel-slide">
      <img src="./img/carousel/carouselle-2.jpeg" alt="img caméra 2">
    </div>
    <!-- Chevron buttons -->
    <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
    <a class="next" onclick="changeSlide(1)">&#10095;</a>
  </div>

  <!-- <div class="slides-container">
    <img src="./img/carousel/carouselle.jpg" alt="carouselle du site" />

  </div> -->
  <p class="section-title">Nouveauté</p>

  <div class="security-alert">
    <p>
      Protégez votre maison : le taux de cambriolages a augmenté de 25% ces
      dernières années. N'attendez plus pour sécuriser votre foyer avec nos
      caméras de surveillance de haute qualité !
    </p>
    <a href="#products" class="cta-button">Découvrez nos caméras</a>
  </div>

  <div class="categorie-container">

    <div class="categorie-espion">
      <h1>Caméra espion</h1>
      <img src="./img\categorie\camera-espion-banner.jpg" alt="image de la categorie espion">
      <button><a href="./categories\camera_espion.php">Voir</a></button>
    </div>

    <div class="categorie-wifi">
      <h1>Caméra wifi</h1>
      <img src="./img\categorie\camera-ip-wifi-banner.jpg" alt="image de la categorie wifi">
      <button><a href="./categories\camerawifi.php">Voir</a></button>
    </div>
    <div class="categorie-kit">
      <h1>Kit videosurveillance</h1>
      <img src="./img\categorie\kit-video-surveillance-banner.jpg" alt="image de la categorie kit">
      <button><a href="./categories\kitvideosurveillance.php">Voir</a></button>
    </div>
  </div>
</body>

</html>


<?php
include ('./Model/footer.php')
  ?>

</body>

</html>