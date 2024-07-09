<?php



function add($image, $name, $price, $desc)
{
    if (require ('connexion-2.php')) {
        // Préparation de la requête
        $req = $objDb->prepare("INSERT INTO products (image, product_name, price, description) VALUES (?, ?, ?, ?)");

        // Exécution de la requête avec les paramètres liés
        $req->execute(array($image, $name, $price, $desc));

        // Fermeture du curseur
        $req->closeCursor();
    }
}



function show()
{
    if (require ('connexion-2.php')) {


        // Préparation de la requête
        $req = $objDb->prepare("SELECT * FROM products ORDER BY id DESC");
        $req->execute();

        // Récupération des résultats
        $reqSql = $req->fetchAll(PDO::FETCH_OBJ);
        return $reqSql;

        $req->closeCursor();

    }
}


function delete($id)
{
    require ('connexion-2.php');
    $stmt = $objDb->prepare("DELETE FROM products WHERE id = ?");
    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $objDb->errorInfo());
    }
    $result = $stmt->execute([$id]);
    if (!$result) {
        die("Erreur d'exécution de la requête : " . $stmt->errorInfo());
    }
}

?>