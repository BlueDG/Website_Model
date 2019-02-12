<?php


// var_dump($_POST);

// 1) connexion à la BDD
require_once '../../../libraries/database.php';

// 2) Récupération des données dans le POST (envoi du formulaire)
$lastName = $_POST['lastname'];
$firstName = $_POST['firstname'];
$phone = $_POST['phoneNumber'];
$email = $_POST['email'];
$password = $_POST['password'];

// 3) Requête de type INSERT 
addClient($lastName, $firstName, $phone, $email, $password);

header('Location: index_client.php');
exit();