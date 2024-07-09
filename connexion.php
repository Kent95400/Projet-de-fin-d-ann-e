<?php

require_once ('param_sql.php'); /*appel du fichier parametrage*/
$objDb = @new mysqli(SQL_HOST, SQL_USER, SQL_PWD, SQL_BDD); /* connection à la base de données*/
if ($objDb->connect_errno) {
  error_log('Connection error:' . $objDb->connect_error);
  exit;
}
$loggedIn = isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : false;

$signupError = "";
$signupSuccess = "";
$loginError = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['sign-up1'])) {
    $last_name = $objDb->real_escape_string($_POST['last_name']);
    $first_name = $objDb->real_escape_string($_POST['first_name']);
    $email = $objDb->real_escape_string($_POST['email']);
    $password = md5($objDb->real_escape_string($_POST['password']));

    if (empty($last_name) || empty($first_name) || empty($email) || empty($password)) {
      $signupError = "Tous les champs sont obligatoires.";
    } else {
      $sRequete = "INSERT INTO `users`(`last_name`,`first_name`, `email`, `password`) VALUES ('$last_name','$first_name','$email','$password')";
      if ($objDb->query($sRequete)) {
        $signupSuccess = "Vous êtes inscrit";
      } else {
        $signupError = "Aucune donnée n'a été enregistrée. Erreur: " . $objDb->error;
      }
    }
  } elseif (isset($_POST['sign-in'])) {
    $email = $objDb->real_escape_string($_POST['email']);
    $password = md5($objDb->real_escape_string($_POST['password']));

    if (empty($email) || empty($password)) {
      $loginError = "Tous les champs sont obligatoires.";
    } else {
      $sRequete = "SELECT `id`, `first_name`, `last_name`, `email`, `is_admin` FROM users WHERE email='$email' AND password='$password'";
      $objResultat = $objDb->query($sRequete);

      if ($objResultat->num_rows > 0) {
        $user = $objResultat->fetch_assoc();
        $_SESSION['loggedIn'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['is_admin'] = $user['is_admin'];
        echo "<script>window.location.href='page_accueil.php';</script>"; // Redirige après connexion
        exit();
      } else {
        $loginError = "Erreur: Identifiants incorrects";
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Page d'accueil</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="reset.css" />
  <link rel="stylesheet" href="style.css" />
  <script src="./JS/connexion.js" defer></script>
  <script src="./JS/carousel.js" defer></script>
  <script src="./JS/script.js" defer></script>
</head>

<body>
  <div class="container" id="container">
    <div class="form-container sign-up">
      <form method="post">
        <h1>Creer un compte</h1>
        <div class="social-icons">
          <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
          <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
          <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
        </div>
        <span>ou utiliser un email pour vous enregistrer</span>
        <input type="text" placeholder="Nom" id="last_name" name="last_name"
          value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>" required />
        <input type="text" placeholder="Prénom" id="first_name" name="first_name"
          value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>" required />
        <input type="email" placeholder="Email" id="email" name="email" autocomplete="email"
          value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required />
        <input type="password" placeholder="Mot de passe" id="password" name="password" autocomplete="new-password"
          value="<?= htmlspecialchars($_POST['password'] ?? '') ?>" required />
        <button type="submit" name="sign-up1" class="sign-up1">S'inscrire</button>
        <?php if (!empty($signupError)): ?>
          <p style="color: red;"><?= htmlspecialchars($signupError) ?></p>
        <?php elseif (!empty($signupSuccess)): ?>
          <p style="color: green;"><?= htmlspecialchars($signupSuccess) ?></p>
        <?php endif; ?>
      </form>
    </div>

    <div class="form_container_sign-in">
      <form method="post">
        <h1>Connexion</h1>
        <div class="social-icons">
          <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
          <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
          <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
        </div>
        <input type="email" placeholder="Email" id="email" name="email"
          value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required />
        <input type="password" placeholder="Mot de passe" id="password" name="password"
          value="<?= htmlspecialchars($_POST['password'] ?? '') ?>" required />
        <button type="submit" name="sign-in" class="sign-in">Connexion</button>
        <?php if (!empty($loginError)): ?>
          <p style="color: red;"><?= htmlspecialchars($loginError) ?></p>
        <?php endif; ?>
      </form>
    </div>

    <div class="toggle-container">
      <div class="toggle">
        <div class="toggle-panel toggle-left">
          <h1>Bienvenue à nouveau !</h1>
          <p>Saisissez vos données personnelles pour utiliser toutes les fonctionnalités du site</p>
          <button class="hidden" id="login">Connexion</button>
        </div>
        <div class="toggle-panel toggle-right">
          <h1>Hello, bienvenue !</h1>
          <p>Enregistrez-vous avec vos données personnelles pour utiliser toutes les fonctionnalités du site.</p>
          <button class="hidden" id="register">S'inscrire</button>
        </div>
      </div>
    </div>
  </div>
</body>

</html>