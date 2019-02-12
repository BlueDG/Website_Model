<?php

//  var_dump($_POST);

// connexion à la BDD
//require_once '../../../libraries/database.php';
require_once '../../../libraries/models/CategoryModel.php';

// extraction des infos du POST
$categoryTitle = $_POST['categoryTitle'];
$categoryId = $_POST['categoryId'];

// requête vers BDD
$model = new CategoryModel();
$model->update(['title' => $categoryTitle, 'id' => $categoryId]);

 header('Location: index_category.php');
// var_dump($_POST);
exit();