<?php
require ("../controler/commandes.php");

$products = show();

// Traitement du formulaire d'ajout
if (isset($_POST['ajouter'])) {
    if (!empty($_POST['image']) && !empty($_POST['product_name']) && !empty($_POST['price']) && !empty($_POST['description'])) {
        $image = htmlspecialchars(strip_tags($_POST['image']));
        $name = htmlspecialchars(strip_tags($_POST['product_name']));
        $price = htmlspecialchars(strip_tags($_POST['price']));
        $desc = htmlspecialchars(strip_tags($_POST['description']));

        try {
            add($image, $name, $price, $desc);
            echo "<div class='alert alert-success'>Produit ajouté avec succès !</div>";
            // Recharger les produits après l'ajout
            $products = show();
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Erreur : " . $e->getMessage() . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Veuillez remplir tous les champs.</div>";
    }
}

// Traitement du formulaire de suppression
if (isset($_POST['supprimer'])) {
    if (!empty($_POST['id'])) {
        $id = htmlspecialchars(strip_tags($_POST['id']));
        try {
            delete($id);
            echo "<div class='alert alert-success'>Produit supprimé avec succès !</div>";
            // Recharger les produits après la suppression
            $products = show();
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Erreur : " . $e->getMessage() . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Veuillez remplir l'ID du produit.</div>";
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
    <title>Ajout et Suppression de produits</title>
</head>

<body>
    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="col-xs-12 col-md-offset-3 col-sm-6 col-md-12">
                <form method="post">
                    <div class="mb-3">
                        <h2 class="text-center mb-4">Ajouts des produits</h2>
                        <label class="form-label">Titre de l'image</label>
                        <input type="text" class="form-control" name="image" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nom du produit</label>
                        <input type="text" class="form-control" name="product_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prix</label>
                        <input type="number" class="form-control" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" required></textarea>
                    </div>
                    <button type="submit" name="ajouter" class="btn btn-primary m-3">Ajouter un nouveau produit</button>
                </form>

                <form method="post">
                    <div class="mb-3">
                        <h2 class="text-center mb-4">Suppression des produits</h2>
                        <label class="form-label">ID du produit</label>
                        <input type="number" class="form-control" name="id" required>
                    </div>
                    <button type="submit" name="supprimer" class="btn btn-danger mb-3">Supprimer le produit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($products as $product): ?>
                    <div class="col-md-2 text-center">
                        <div class="card shadow-sm">
                            <h4>ID : <?= $product->id ?></h4>
                            <img src="<?= $product->image ?>" class="card-img-top">
                            <div class="card-body">
                                <h6 class="card-title"><?= htmlspecialchars($product->product_name) ?></h6>
                                <p class="card-text"><strong>Prix:</strong> <?= htmlspecialchars($product->price) ?> €</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</body>

</html>