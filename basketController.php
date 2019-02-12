<?php

require_once('libraries/utils.php');
require_once 'libraries/database.php';
require_once 'libraries/security.php';

$task = $_GET['task'];

if($task == 'add'){
    addMealToBasket();
} elseif($task == 'show'){
    showBasket();
} elseif($task == 'delete'){
    deleteFromBasket();
}




function addMealToBasket()
{
    
    $id = $_GET['id'];
    
    // On initialise le panier
    initializeCart();
    
    addToCart($id);
    
    // var_dump($_SESSION);
    
    
    redirect('index.php');
    
    /*header('Location: index.php');
    exit();*/ 
}



function showBasket()
{
    
    $meals = getMealsFromCart();
    
    // le 'meals' ici est le $meals de la boucle foreach dans basket.phtml
    $variables = [
        'meals' => $meals
    ];
    // var_dump($_SESSION['panier']);
    // var_dump($meals);
    display('views/basket.phtml', $variables);
}



function deleteFromBasket()
{
    

    $index = $_GET['index'];
    
    // Suppression de l'élément qui se trouve à l'emplacement $index dans le tableau SESSION['panier']
    removeFromCart($index);
    
    // Redirection
    redirect('basketController.php?task=show');
}