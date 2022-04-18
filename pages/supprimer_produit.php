<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/sass/styles.css">
    <title>MICASHOP - PRODUITS - </title>
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
            //echo "Connexion a PDO";

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }


        if (isset($_POST['btn-delete'])) {
            echo "click salut";
            $sql = "DELETE FROM `produits` WHERE `id_produit` = ?";

            $delete = $dbh->prepare($sql);
            $id = $_GET['id_produit'];
            $delete->bindParam(1, $id);
            $delete->execute();

            if($delete) {
                echo "<div class='text-center'>
                           <p class='alert alert-success'>Votre produit a bien été supprimer</p>
                    </div>"
                ?>
                <style>
                    #details_produit{
                        display: none;
                    }
                </style>
        <?php
            } else {
                echo "erreur";
            }
        }


        //0 - Une cles etrangère est une reference a une cle primaire d'une autre table
        //1- Selectionne tous de la table produits
        //2- Joint la table categories ou (table) produits.(cle etrangère) = (table) categories.(cle primaire)
        //3 - Joint la table vendeurs ou (table) produits.(cle etrangère) =  (table) vendeurs.(cle primaire)
        //4 - Joint la tablecommentaires ou (table) produits.(cle etrangère) = (table)  commentaires.(cle primaire)
        //5 - On ajoute le prediquat where qui filtre les produits par id (cle primaire des produits)

        $sql = "SELECT * FROM `produits` 
        INNER JOIN categories ON produits.categorie_id = categories.id_categorie 
        INNER JOIN vendeurs ON produits.vendeur_id = vendeurs.id_vendeur
        WHERE id_produit = ?";

        //lutte contre les injection SQL
        $request = $dbh->prepare($sql);
        //On recup l'id dans url enboyée par : depuis la page produits.php
        /*
         <a href="details_produits.php?id_produit=<?= $produit['id_produit'] ?>" class="btn btn-success">Details du produits</a>
         */
        $id = $_GET['id_produit'];
        //On lie les paramètres
        //Ici 1 = WHERE id_produit = ?
        //et devient : $_GET['id_produit'];
        $request->bindParam(1, $id);
        //On execute la requète
        $request->execute();
        //On liste le resultat de la requète
        $details_produit = $request->fetch();
        //Debug
        //var_dump($details_produit);

        ?>
        <div class="container details_produits" id="details_produit">
            <div class="titre-produit-container">
                <h2 class="text-danger"><?= $details_produit['nom_produit']; ?></h2>
            </div>

            <div class="text-center">
                <img src="<?= $details_produit['image_produit'] ?>" alt="<?= $details_produit['nom_produit']; ?>" title="<?= $details_produit['nom_produit']; ?>" class="img-details-produit img-thumbnail">
            </div>

            <p class="mt-3">Catégories : <b class="text-info"><?= $details_produit["categorie"]; ?></b></p>
            <p class="text-info"><b>Description :</b></p>
            <em><?= $details_produit["description_produit"]; ?></em>
            <p>Prix : <b class="text-success"><?= $details_produit["prix_produit"]; ?> €</b></p>
            <!--LES DATES-->
            <!--LE STOCK BOOL-->
            <!--LE NOM DES VENDEURS-->
            <p class="text-danger">Nom du vendeur : <?= $details_produit['nom_vendeur'] ?></p>
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

            <form method="post">
                <button type="submit" name="btn-delete" class="mt-3 btn btn-danger">Confirmer la suppression du produit</button>
            </form>



        </div>

    </div>
</div>
</body>
</body>