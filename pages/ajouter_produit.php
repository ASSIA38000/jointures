<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/sass/styles.css">
    <title>AJOUT PRODUIT</title>
</head>

<body>

<header>
    <?php
    require_once "menu.php";
    ?>
</header>

<div class="mt-4 container bg-main overflow-hidden">
    <div class="row g-2">

<?php

try {
    $dbh = new PDO('mysql:host=localhost;dbname=test-mcd;charset=UTF8', "root", "");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

?>
        <div class="text-center">
            <h3 class="text-primary mt-5 mb-5">AJOUTER UN PRODUIT</h3>
        </div>
        
        <form class="details_produits" method="post" action="traitement_ajouter_produit.php" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="nom_produit" class="form-label">Nom du produit</label>
                <input type="text" class="form-control" id="nom_produit" name="nom_produit" required>
            </div>

            <div class="mb-3">
                <label for="description_produit" class="form-label">Description</label>
                <textarea class="form-control" rows="5" id="description_produit" name="description_produit" required></textarea>
            </div>

            <div class="mb-3">
                <label for="prix_produit" class="form-label">Prix du produit</label>
                <input type="number" step="0.01" class="form-control" id="prix_produit" name="prix_produit" required>
            </div>

            <div class="mb-3">
                <label for="stock_produit" class="form-label">Disponible</label>
                <select class="form-control" name="stock_produit" id="stock_produit" required>
                    <option value="0">OUI</option>
                    <option value="1">NON</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="date_depot" class="form-label">Date de dépôt du produit</label>
                <input type="date" class="form-control" id="date_depot" name="date_depot" required>
            </div>

            <div class="mb-3">
                <label for="image_produit" class="form-label">Image du produit</label>
                <input type="file" class="form-control" id="image_produit" name="image_produit" required>
            </div>

            <div class="mb-3">
                Catégorie
                <select name="categories" class="form-control">
                    <?php
                        $sql = "SELECT * FROM categories";
                        $categories = $dbh->query($sql);
                        foreach ($categories as $category){
                            ?>
                            <option value="<?= $category['id_categorie'] ?>"><?= $category['id_categorie'] ?></option>
                    <?php
                        }

                    ?>
                </select>
            </div>

            <div class="mb-3">
                Vendeur
                <select name="vendeurs" class="form-control">
                    <?php
                    $sql = "SELECT * FROM vendeurs";
                    $vendeurs = $dbh->query($sql);
                    foreach ($vendeurs as $vendeur){
                        ?>
                        <option value="<?=  $vendeur['id_vendeur'] ?>"><?= $vendeur['nom_vendeur'] ?></option>
                        <?php
                    }

                    ?>
                </select>
            </div>

            <div class="mt-5 mb-4 text-end">
                <button type="submit" class="btn btn-success">Valider le produit</button>
            </div>


        </form>

    </div>
</div>
</body>
</html>

