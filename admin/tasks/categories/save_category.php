<?php


// var_dump($_POST);

// 1) connexion à la BDD
//require_once '../../../libraries/database.php';
require_once '../../../libraries/models/CategoryModel.php';

// 2) Récupération des données dans le POST (envoi du formulaire)
$title = $_POST['categoryTitle'];

// 3) Requête de type INSERT 
$model = new CategoryModel();
$model->insert(['title' => $title]);

header('Location: index_category.php');
exit();