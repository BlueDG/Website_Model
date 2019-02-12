<?php

$id = $_GET['id'];

// connexion BDD
// require_once '../../../libraries/database.php';
require_once '../../../libraries/models/CategoryModel.php';

// requête de type DELETE
$model = new CategoryModel();
$model->delete($id);

header('Location: index_category.php');
exit();