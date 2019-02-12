<?php

//  var_dump($_POST);

// connexion à la BDD
require_once '../../../libraries/database.php';

// extraction des infos du POST
$lastName = $_POST['lastName'];
$firstName = $_POST['firstName'];
$date = $_POST['date'];
$phone = $_POST['phone'];
$number = $_POST['number'];
$id = $_POST['reservationId'];

// requête vers BDD
updateReservation($lastName, $firstName, $date, $phone, $number, $id);

 header('Location: index_reservation.php');
// var_dump($_POST);
exit();