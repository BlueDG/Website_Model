<?php

// var_dump($_GET);
$id = $_GET['id'];

// connexion à la BDD
// require_once '../../../libraries/database.php';
require_once '../../../libraries/models/MealModel.php';

// Requête sql récupérer id spécifique dans la BDD
$model = new MealModel();
$meal = $model->find($id);

// var_dump($meal);


include '../../views/meals/edit.phtml';