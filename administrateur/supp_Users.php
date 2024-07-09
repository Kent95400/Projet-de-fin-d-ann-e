<?php
if (isset($_GET['id'])) {
    $id = $_GET["id"];

    require_once '../param_sql.php'; /*appel du fichier parametrage*/
    $objDb = new mysqli(SQL_HOST, SQL_USER, SQL_PWD, SQL_BDD); /* connection à la base de données*/
    if ($objDb->connect_errno) {
        error_log('Connection error:' . $objDb->connect_error);
        exit;
    }

    $sql = "DELETE FROM users WHERE id = $id";
    $objDb->query($sql);

}
header("location: users.php");
exit;
?>