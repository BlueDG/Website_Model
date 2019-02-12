<?php

// connexion à la BDD
require_once '../../../libraries/database.php';

// Récupération de l'identifiant en GET comme pour les fichier edit.php ou delete.php
// => On veut savoir de quelle commande on veut voir les informations
// => ici.
$id = $_GET['id'];
// var_dump($_GET);

// Créer une requête préparée qui va chercher les données de la table order pour la commande qui a cet id
// Execute la requête et stoque la commande qui remonte de la base de données
//  => Puis un var_dump de la commande et tu m'appelles


 // $orderDetail = getOrderDetails();
$sql = "SELECT *
        FROM `order`
        WHERE ID = ?"; 

    $query = $pdo->prepare($sql);
    $query->execute([$id]);
    $orderDetail = $query->fetch(PDO::FETCH_ASSOC);

// var_dump($orderDetail);

// Créer une requête qui va chercher les produits qui sont liés à la commande
// Executer la requete et remonter les lignes
// => Puis var_dump des produits
$sql= "SELECT meal.* FROM meal 
        INNER JOIN order_meal ON order_meal.meal_id = meal.id
        WHERE order_meal.order_id = ?";
        
    $query = $pdo->prepare($sql);
    $query->execute([$id]);
    $meals = $query->fetchAll(PDO::FETCH_ASSOC);

// inclusion du phtml
include '../../views/orders/order_details.phtml';