<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/sass/styles.css">
    <title>PRODUITS</title>
</head>

<body>
    
<header>
    <?php
        require_once "menu.php";
    ?>
</header>

<body>
    <div class="mt-4 container bg-main overflow-hidden">
        <div class="text-center mt-4 mb-5">
            <a href="ajouter_produit.php" class="btn btn-success">Ajouter un produit</a>
        </div>
        <div class="row g-2">
            <?php

            try {
                $dbh = new PDO('mysql:host=localhost;dbname=test-mcd;charset=UTF8', "root", "");
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage() . "<br/>";
                die();
            }

            $sql = "SELECT * FROM produits 
                    INNER JOIN categories ON produits.categorie_id = categories.id_categorie 
                    INNER JOIN vendeurs ON produits.vendeur_id = vendeurs.id_vendeur ";
            $produits = $dbh->query($sql);

            foreach ($produits as $produit) {
                ?>
                    <div class="mt-3 produits col-md-3 col-sm-12">

                        <div class="titre-produit-container">
                            <h2 class="text-info"><?= $produit['nom_produit']; ?></h2>
                        </div>

                        <img src="<?= $produit['image_produit'] ?>" alt="<?= $produit['nom_produit']; ?>" title="<?= $produit['nom_produit']; ?>" class="img-produit img-thumbnail">
                        <p class="mt-3">Catégories : <b class="text-primary"><?= $produit["id_categorie"]; ?></b></p>
                        <p class="text-primary"><b>Description :</b></p>
                        <em><?= $produit["description_produit"]; ?></em>
                        <p>Prix : <b class="text-success"><?= $produit["prix_produit"]; ?> €</b></p>
                        <p class="text-primary">Nom du vendeur : <?= $produit['nom_vendeur'] ?></p>
                        <div class="text-center">
                            <a href="details_produits.php?id_produit=<?= $produit['id_produit'] ?>" class="mb-2 btn btn-primary">Détails du produit</a>
                            <a href="supprimer_produit.php?id_produit=<?= $produit['id_produit'] ?>" class="mb-2 btn btn-danger">Supprimer le produit</a>
                        </div>

                    </div>
                <?php
                }
            ?>
        </div>
    </div>
</body>
</html>
