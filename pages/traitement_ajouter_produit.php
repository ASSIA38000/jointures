<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/sass/styles.css">
    <title>TRAITEMENT AJOUTER PRODUIT</title>
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

//Upload de photo
if(isset($_FILES['image_produit'])){
    //Repertoire de destination
    $repoertoireDestination = "../assets/img/";
    //Dans une variable = repertoire de setination + retour a la racine du projet + image uploader + son nom et extenssion
    $photo_produit = $repoertoireDestination . basename($_FILES['image_produit']['name']);

    //L'elelnt recuperer dans le formulaire est assigner a la variable creer ci desssus
    $_POST['image_produit'] = $photo_produit;

    //Si le deplacement de la photo fonctionne
    //FROM -> TO
    //FROM = La source du formulaire = image uploader + nom temporaire TO = la destination + le nom de l'image
    if(move_uploaded_file($_FILES['image_produit']['tmp_name'], $photo_produit)){
        //Si ca marche
        echo "<p class='alert alert-success'>Votre photo a bien été telecharger</p>";
    }else{
        //Sinon erreur
        echo "error";
    }
}

//La requète d'insertion du produit + les 2 cles etrangères (INT entier)

$sql = "INSERT INTO `produits`(`id_produit`, `nom_produit`, `description_produit`, `prix_produit`, `stock_produit`, `date_depot`, `image_produit`, `categorie_id`, `vendeur_id`) VALUES (?,?,?,?,?,?,?,?,?)";
//On stocke dans une variable une requète préparée (lutte contre les injections SQL)
$insert = $dbh->prepare($sql);

//On lie les paramètres de la requète aux champs du formaulaire
$insert->bindParam(1, $_POST['id_produit']);
$insert->bindParam(2, $_POST['nom_produit']);
$insert->bindParam(3, $_POST['description_produit']);
$insert->bindParam(4, $_POST['prix_produit']);
$insert->bindParam(5, $_POST['stock_produit']);
$insert->bindParam(6, $_POST['date_depot']);
$insert->bindParam(7, $_POST['image_produit']);
$insert->bindParam(8,$_POST['categories']);
$insert->bindParam(9,$_POST['vendeurs']);

//Execute la requète et retourne un tableau associatif cle-valeur
$insert->execute(
        array(
            $_POST['id_produit'],
            $_POST['nom_produit'],
            $_POST['description_produit'],
            $_POST['prix_produit'],
            $_POST['stock_produit'],
            $_POST['date_depot'],
            $_POST['image_produit'],
            $_POST['categories'],
            $_POST['vendeurs'],

        ));

//Si ca marche
if($insert){
    echo "<p class='container alert alert-success'>Votre produit a été ajouté avec succès !</p>";
    echo "<div class='text-center'><a href='produits.php' class='container btn btn-success'>Voir mon produit</a></div>";
}else{
    echo "<p class='alert alert-danger'>Erreur lors de l'ajout de produit</p>";
}

?>

    </div>
</div>
</body>
</html>
