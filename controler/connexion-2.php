<?php
try {
    // Connexion à la base de données en utilisant PDO
    $objDb = new PDO("mysql:host=localhost;dbname=security shield;charset=utf8", "root", "");
    $objDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log('Connection error: ' . $e->getMessage());
    return false;
}
?>