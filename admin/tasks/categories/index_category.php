<?php

// connexion à la BDD
// require_once '../../../libraries/database.php';
/*require_once '../../../libraries/models/CategoryModel.php';

        // le resultat de la fonction getDogs va dans la variable $meals
        // ça permet de faire resortir le $resultats qui est DANS la fonction (il est aussi possible de le faire sortir grâce au return)
        $model = new CategoryModel();
        $categories = $model->getAll();
        
        // test sur la récupération
        // var_dump($_getMeals);
        
        // inclusion du phtml
        include '../../views/categories/list_category.phtml';
    }*/
    
require_once '../../../libraries/controllers/CategoryController.php';


$controller = new CategoryController();
$controller->index();