<?php

require_once 'libraries/database.php';
require_once 'libraries/utils.php';
require_once 'libraries/security.php';
    
    
$task = $_GET['task'];

switch($task){
    case 'orderForm':
        showOrderForm();
        break;
    case 'saveOrder':
        saveOrder();
        break;
    case 'confirmOrder':
        showConfirmOrder();
        break;
}



function showOrderForm()
{
    display('views/order.phtml');
}

function saveOrder()
{
    
    
    // 2) Récupération des données dans le POST (envoi du formulaire)
    $lastName = $_POST['lastname'];
    $firstName = $_POST['firstname'];
    $phone = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $postalCode = $_POST['postalCode'];
    $city = $_POST['city'];
    $review = $_POST['review'];
    
    $id = addOrder($lastName, $firstName, $email, $phone, $address, $postalCode, $city, $review);
    
    // Pour chaque produit du panier ($_SESSION['panier'])
    // On veut insérer une ligne dans la table order_meal
    // [1, 2, 1, 3]
    foreach(getCart() as $mealId) {
        addMealToOrder($mealId, $id);
    }
    
    emptyCart();
    redirect('order_confirm.php');
    // Redirection vers page de remerciement :
    // redirect('orderController.php?task=confirmOrder');
}


/* function showConfirmOrder() {
    require_once('views/remerciements.phtml');
}*/