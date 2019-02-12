<?php

// connexion à la BDD
require_once '../../../libraries/database.php';

$clients = getClients();

// test sur la récupération
// var_dump($reservations);

// inclusion du phtml
include '../../views/clients/list_client.phtml';