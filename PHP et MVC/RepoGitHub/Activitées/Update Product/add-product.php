<?php
$error_name = null;
$error_price = null;
$error_description = null;
$general_message = null;

if(isset($_POST["name"]) && isset($_POST["price"]) && isset($_POST["description"])){
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];

    if(strlen($name) < 2){
        $error_name = "Product name too short, at least 2 characters required.";
    }
    if($price<0){
        $error_price = "Product price must be positive or 0";
    }
    if(strlen($description)<5){
        $error_description = "Product description too short, at least 5 characters required.";
    }
    if(!$error_name && !$error_description && !$error_price){
        try {
            $bdd = new PDO("mysql:host=lamp-mysql;dbname=eval;","root","root");
            $bdd->query("INSERT INTO `Product` (`id`, `name`, `price`, `description`) VALUES (NULL, '".$name."', '".$price."', '".$description."') ");
            $general_message = "Produit ajouté dans la table";
        } catch (PDOException $e) {
            $general_message = "SQL error";
            echo $e->getMessage();
        }
    }
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <header class="header">
        <a href="index.php">Home</a>
        <a href="add-product.php">New product</a>
    </header>
    <section class="content">
        <form action="add-product.php" method="post" class="form_add">
            <label for="name">Product name</label>
            <input type="text" name="name" id="name">

            <label for="price">Prix</label>
            <input type="number" name="price" id="number">

            <label for="description">Description du produit</label>
            <textarea name="description" id="description" cols="30" rows="10"></textarea>
            <input type="submit" value="Créer le produit">
        </form>
        <p class="error"><?= $general_message?></p>
        <p  class="error"><?= $error_name?></p>
        <p  class="error"><?= $error_price?></p>
        <p  class="error"><?= $error_description?></p>
    </section>
</body>
</html>