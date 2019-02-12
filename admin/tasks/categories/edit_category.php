<?php

/*/ var_dump($_GET);
$id = $_GET['id'];

// connexion à la BDD
//require_once '../../../libraries/database.php';
require_once '../../../libraries/models/CategoryModel.php';


// Requête sql récupérer id spécifique dans la BDD
$model = new CategoryModel();
$category = $model->find($id);

// var_dump($meal);


include '../../views/categories/edit_category.phtml';*/


require_once '../../../libraries/controllers/CategoryController.php';


$controller = new CategoryController();
$controller->edit();