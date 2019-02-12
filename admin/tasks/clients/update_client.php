<?php

//  var_dump($_POST);

// connexion à la BDD
require_once '../../../libraries/database.php';

// extraction des infos du POST
$lastName = $_POST['lastName'];
$firstName = $_POST['firstName'];
$phoneNumber = $_POST['phoneNumber'];
$email = $_POST['email'];
$password = $_POST['password'];
$id = $_POST['clientId'];

// requête vers BDD
updateClient($lastName, $firstName, $phoneNumber, $email, $password, $id);

 header('Location: index_client.php');
// var_dump($_POST);
exit();