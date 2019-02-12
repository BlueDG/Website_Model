<?php

// var_dump($_GET);
$id = $_GET['id'];

// connexion à la BDD
require_once '../../../libraries/database.php';


// Requête sql récupérer id spécifique dans la BDD
$reservation = getReservation($id);

// var_dump($meal);


include '../../views/reservations/edit_reservation.phtml';