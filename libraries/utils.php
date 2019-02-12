<?php

require_once 'libraries/database.php';

session_start();

/**
 *permet de rediriger vers une URL
 * 
 * @param string $target l'URL vers laquelle on veut rediriger
 */
function redirect($target) 
{
    header('Location: ' . $target);
    exit();
}

// permet d'afficher une page complète
function display($path, $vars = [])
{
    extract($vars);
    
    require_once('views/partials/header.phtml');
    require_once($path);
    require_once('views/partials/footer.phtml');
}




/**
 * il crée le panier dans la session s'il n'existe pas encore
 * 
 * @return void
 */
 
function initializeCart()
{
    if(empty($_SESSION['panier'])){
    $_SESSION['panier'] = [];
    }
}


/**
 * elle permet d'ajouter les articles au panier
 * 
 * @return void
 */
 
function addToCart($id){
    $_SESSION['panier'][] = $id;
}


function removeFromCart($index)
{
    array_splice($_SESSION['panier'], $index, 1);
}


/**
 *récupère le contenu du panier
 * 
 * @return array le tableau des id des plats sélectionnés
 * 
 */
 
function getCart()
{
    initializeCart();
    return $_SESSION['panier'];
}


/**
 *récupère les infos complètes des produits du panier
 * 
 * @return array 
 * 
 */

function getMealsFromCart() 
{
    $meals = [];

    foreach(getCart() as $mealId)
        {
            // 1) Aller chercher les informations du produit dont l'identifiant correspond à $id
            $meal = getMeal($mealId);
            
            // 2) Stocker ces informations dans le tableau $meals
            $meals[] = $meal;
            
        }
    return $meals;
}

// permet de vider le panier
// @return void

function emptyCart()
{
    $_SESSION['panier'] = [];
}