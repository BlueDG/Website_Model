<?php


// var_dump($_POST);

// 1) connexion à la BDD
// require_once '../../../libraries/database.php';
require_once '../../../libraries/models/MealModel.php';

// 2) Récupération des données dans le POST (envoi du formulaire)
$title = $_POST['mealTitle'];
// var_dump($nom);
$description = $_POST['mealDescription'];

var_dump($description);

$description = strip_tags($description, '<strong><em>');

var_dump($description);
die();

$price = $_POST['mealPrice'];
$image = $_POST['mealImage'];
$vegan = $_POST['vegan'];
$category = $_POST['category_id'];

// 3) Requête de type INSERT 
$model = new MealModel();
$model->insert(['title' => $title, 'description' => $description, 'price' => $price, 'image' => $image, 'vegan' => $vegan, 'category_id' => $category]);

header('Location: ../../index.php');
exit();