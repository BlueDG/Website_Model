<?php

require_once('../libraries/security.php'); // comme le database

checkAdminAccess();



// connexion à la BDD
// require_once '../libraries/database.php';
require_once '../libraries/models/MealModel.php';
$model = new MealModel();

// le resultat de la fonction getDogs va dans la variable $meals
// ça permet de faire resortir le $resultats qui est DANS la fonction (il est aussi possible de le faire sortir grâce au return)
$meals = $model->getAll();

// test sur la récupération
// var_dump($_getMeals);

// inclusion du phtml
include 'views/meals/list.phtml';