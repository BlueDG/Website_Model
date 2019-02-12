<?php


session_start();
require_once 'database.php';

/**
 * cette fonction permet de savoir si le visiteur est connecté ou pas
 * 
 * @return bool True si connecté False s'il ne l'est pas
 * 
 */
function isConnected() 
{
    if(empty($_SESSION['user']))
    {
        return false;
    }

    return true;
}

function isAdmin()
{
    if(isConnected() == true && $_SESSION['user']['admin'] == 1)
    {
        return true;
    }
    return false;
}


/**
 * Cette fonction permet de bloquer un visiteur qui ne doit pqs qvoir qcces à l'administration. 
 * 
 * @return void
 */
function checkAdminAccess()
{
     // si la personne n'est pas connectée
    if(isConnected() == false)
    {
        echo "veuillez vous connecter pour accéder à cette partie.";
        exit();
    }
    
    if(isAdmin() == false)
    {
        echo "Vous n'avez pas le droit d'accéder à cette partie.";
        exit();
    }
}


/**
 * elle permet d'authentifier un user en checkant son email et password
 * 
 * @param string $email
 * @param string $password
 * @return void
 */ 
function authenticate($email, $password)
{
    $user = getUserByEmail($email); 
    
    if($user == false) {
        echo "Aucun utilisateur connu avec cet email.";
        exit();
        
    }
    
    
    // vérifions si le mdp est le même que le hash
    // le param 1 est ce qu'il a tapé et le param 2 est le password de la BDD transform avec le Hash
    $validation = password_verify($password, $user['password']);
    if($validation == false) {
        echo "votre mot de passe n'est pas le bon.";
        exit();
    }
    
    
    $_SESSION['user'] = $user;
}