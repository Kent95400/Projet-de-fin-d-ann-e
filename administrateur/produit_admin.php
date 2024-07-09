<?php

require ("../controler/commandes.php");



if (isset($_POST['valider'])) {
    if (isset($_POST['image']) and isset($_POST['product_name']) and isset($_POST['price']) and isset($_POST['description'])) {
        if (!empty($_POST['image']) and !empty($_POST['product_name']) and !empty($_POST['price']) and !empty($_POST['description'])) {

            $image = htmlspecialchars(strip_tags($_POST['image']));
            $name = htmlspecialchars(strip_tags($_POST['product_name']));
            $price = htmlspecialchars(strip_tags($_POST['price']));
            $desc = htmlspecialchars(strip_tags($_POST['description']));

            try {
                add($image, $name, $price, $desc);
            } catch (Exception $e) {
                $e->getMessage();
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <title>Ajout de produits</title>
</head>

<body>

    <div class="album py-5 bg-body-tertiary">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Titre de l'image</label>
                        <input type="name" class="form-control" name="image" required>

                    </div>
                    <div class="mb-3">
                        <label " class=" form-label">Nom du produit</label>
                        <input type="text" class="form-control" name="product_name" required>
                    </div>
                    <div class="mb-3">
                        <label " class=" form-label">Prix</label>
                        <input type="number" class="form-control" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label " class=" form-label">Description</label>
                        <textarea class="form-control" name="description" required></textarea>

                        <button type="submit" name="valider" class="btn btn-primary m-3">Ajouter un nouveau
                            produit</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>