<?php

$id = $_GET['id'];

// connexion BDD
require_once '../../../libraries/database.php';

// requête de type DELETE
deleteReservation($id);

header('Location: index_reservation.php');
exit();







