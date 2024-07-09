<?php
session_start();
require_once ('./param_sql.php'); /*appel du fichier parametrage*/
$objDb = @new mysqli(SQL_HOST, SQL_USER, SQL_PWD, SQL_BDD);/* connection à la base de données*/
if ($objDb->connect_errno) {
    error_log('Connection error:' . $objDb->connect_error);
    exit;
}
$loggedIn = isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : false;

include ('./Model/header.php')
    ?>





<?php

include ('./Model/footer.php')
    ?>