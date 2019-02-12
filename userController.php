<?php

require_once 'libraries/utils.php';
require_once('libraries/security.php');
require_once('libraries/database.php');

$task = $_GET['task'];

switch($task) {
    case 'registerForm':
        showUserForm();
        break;
    case 'loginForm':
        showLoginForm();
        break;
    case 'logout':
        logout();
        break;
    case 'register':
        saveInscription();
        break;
    case 'authentication':
        authentication();
        break;
}




function showUserForm()
{
    display('views/inscription.phtml');
}



function showLoginForm()
{
    display('views/login.phtml');
}




function logout()
{
   

    $_SESSION['user'] = null;
    
    redirect('index.php');
}


function saveInscription()
{
    // var_dump($_POST);

  
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];
    $username = $_POST['username'];
    
    
    $hash = password_hash($password, PASSWORD_DEFAULT);
    
    /*var_dump($hash);
    die(); // exit = die c'est un alias ; ce qui est en dessous ne se fera pas */
    
    addUser($email, $hash, $username);
    // pour faire un admin on utiliserait cette fonction avec addUser($email, $hash, $username, 1);
    
    
    redirect('userController.php?task=loginForm');
    
    // avant la requête sql il faut hasher le password

}


function authentication()
{
    
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    
    authenticate($email, $password);
    
    redirect('index.php');
}

