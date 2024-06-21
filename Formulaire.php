<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css" />
        <link rel="stylesheet" href="./css/style.css" />
    <title>formulaire</title>
    <?php

        require_once('param_sql.php'); /*appel du fichier parametrage*/ 

        $objDb = @new mysqli(SQL_HOST,SQL_USER,SQL_PWD,SQL_BDD);/* connection à la base de données*/

        if ($objDb->connect_errno){
        error_log('Connection error:' .$objDb->connect_error);
        exit;} 
    ?>
</head>
<body>

<br>
<form action="Formulaire.php" method='post'>
  <label for ="First_name">Nom</label><br>
  <input type="text" id="first_name" name="first_name" value= <?=(isset($_POST['first_name']))?$_POST['first_name']:""?>><br><br>
  <label for="last_name">Prénom</label><br>
  <input type="text" id="last_name" name="last_name" value=<?=(isset($_POST['last_name']))?$_POST['last_name']:""?>><br><br>
  <label for="adress">Entrez votre adresse</label><br>
  <textarea name="adress" id="adress" cols="50" rows="4"><?= (isset($_POST['adress']))?$_POST['adress'] :""?></textarea><br>
  <label for ="email">Email</label><br>
  <input type="email" id="email" name="email" value= <?=(isset($_POST['email']))?$_POST['email']:""?>><br><br>
  <label for ="Password">Mot de passe</label><br>
  <input type="Password" id="Password" name="Password" value= <?=(isset($_POST['Password']))?$_POST['Password']:""?>><br><br>
  <div class = 'boutton'>
    <button name = "validation">Validé</button>
    <button name = "refus">Refusé</button>
  </div>
</form> 

<?php


    if(isset($_POST['validation'])){
       
        $sRequete = "INSERT INTO `users`(`first_name`, `last_name`, `adress`, `email`, `Password`) VALUES ('$_POST[first_name]','$_POST[last_name]','$_POST[adress]','$_POST[email]','".md5($_POST['Password'])."')";
        // echo $sRequete;
        $objResultat = $objDb->query($sRequete);
        if ($objResultat){
            echo $objDb->affected_rows. " <br><br> Vous êtes inscrit";
        } else {
            echo "Aucune donnée n'a été enregistré. Erreur:" .$objDb->error;
        }
    }   

    // .MD5 = cryptage du Password

    if(isset($_POST['refus'])){
        echo "Veuillez remplir à nouveau le formulaire";
    }
?>
</body>
</html>