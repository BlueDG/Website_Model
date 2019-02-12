<?php

$id = $_GET['id'];

// connexion BDD
// require_once '../../../libraries/database.php';
require_once '../../../libraries/models/MealModel.php';

// requête de type DELETE
$model = new MealModel();
$model->delete($id);

header('Location: ../../index.php');
exit();