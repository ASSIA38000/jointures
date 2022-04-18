<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/sass/styles.css">
    <title>DETAILS PRODUIT</title>
</head>
<body>
<header>
    <?php
    require_once "menu.php";
    ?>
</header>
<body>
<div class="mt-4 container bg-main">
    <div class="row ">
<?php

try {
    $dbh = new PDO('mysql:host=localhost;dbname=test-mcd;charset=UTF8', "root", "");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

$sql = "SELECT * FROM `produits` 
        INNER JOIN categories ON produits.categorie_id = categories.id_categorie 
        INNER JOIN vendeurs ON produits.vendeur_id = vendeurs.id_vendeur
        WHERE id_produit = ?";

$request = $dbh->prepare($sql);
$id = $_GET['id_produit'];
$request->bindParam(1, $id);
$request->execute();
$details_produit = $request->fetch();

?>
        <div class="container details_produits">
            <div class="titre-produit-container">
                <h2 class="text-info mb-5"><?= $details_produit['nom_produit']; ?></h2>
            </div>

            <div class="text-center ">
                <img src="<?= $details_produit['image_produit'] ?>" alt="<?= $details_produit['nom_produit']; ?>" title="<?= $details_produit['nom_produit']; ?>" class="img-details-produit img-thumbnail mb-3">
            </div>

            <p class="text-primary mt-5"><b>Catégorie : &nbsp  <?= $details_produit["id_categorie"]; ?></b></p>

            <p class="text-primary"><b>Description :</b></p>
            <em><?= $details_produit["description_produit"]; ?></em></br></br>
            <p>Prix : &nbsp<b class="text-success"><?= $details_produit["prix_produit"]; ?> €</b></p>
            <p class="text-primary">Nom du vendeur : <?= $details_produit['nom_vendeur'] ?></p>
            <?php
                $date = new DateTime($details_produit['date_depot']);
                if($details_produit == true){
                    echo "<p>En stock = OUI</p>";
                }else{
                    echo "<p>En stock = NON</p>";
                }

            ?>
            <p>Date de depot : <?= $date->format("d/m/Y") ?></p>
            <a href="produits.php" class="btn btn-warning">Retour aux produits</a>
        </div>

    </div>
</div>
</body>
</body>