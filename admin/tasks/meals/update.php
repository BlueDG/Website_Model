<?php

//  var_dump($_POST);

// connexion à la BDD
// require_once '../../../libraries/database.php';
require_once '../../../libraries/models/MealModel.php';

// extraction des infos du POST
$title = $_POST['mealTitle'];
$description = $_POST['mealDescription'];
$price = $_POST['mealPrice'];
$image = $_POST['mealImage'];
$vegan = $_POST['vegan'];
$id = $_POST['mealId'];
$category = $_POST['category_id'];

// requête vers BDD
$model = new MealModel();
$model->update(['title' => $title, 'description' => $description, 'price' => $price, 'image' => $image, 'vegan' => $vegan, 'category_id' => $category, 'id' => $id]);

header('Location: ../../index.php');
// var_dump($_POST);
exit();