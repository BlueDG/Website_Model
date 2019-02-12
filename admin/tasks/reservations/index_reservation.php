<?php

// connexion à la BDD
require_once '../../../libraries/database.php';

$reservations = getReservations();

// test sur la récupération
// var_dump($reservations);

// inclusion du phtml
include '../../views/reservations/list_reservation.phtml';