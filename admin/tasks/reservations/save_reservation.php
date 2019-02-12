<?php


// var_dump($_POST);

// 1) connexion à la BDD
require_once '../../../libraries/database.php';

// 2) Récupération des données dans le POST (envoi du formulaire)
$lastName = $_POST['reservationLastname'];
$firstName = $_POST['reservationFirstname'];
$date = $_POST['reservationDate'];
$phone = $_POST['reservationPhone'];
$number = $_POST['reservationNumber'];

// 3) Requête de type INSERT 
addReservation($lastName, $firstName, $number, $phone, $date);

header('Location: index_reservation.php');
exit();