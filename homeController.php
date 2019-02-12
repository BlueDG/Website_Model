<?php

// connexion à la BDD
require_once 'libraries/database.php';
require_once 'libraries/utils.php';
require_once 'libraries/security.php';
    
showHome();

function showHome()
{
    session_start();
    
    // le resultat de la fonction getDogs va dans la variable $meals
    // ça permet de faire resortir le $resultats qui est DANS la fonction (il est aussi possible de le faire sortir grâce au return)
    // $entrees = getEntrees();
    // $plats = getPlats();
    
    $entrees = getMealsFromCategory(1);
    $plats   = getMealsFromCategory(2);
    
    $variables = [
        'entrees' => $entrees,
        'plats' => $plats
    ];
    
    // test sur la récupération
    // var_dump($_getMeals);
    display('views/index.phtml', $variables);
}