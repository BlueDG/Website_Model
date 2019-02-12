<?php

// var_dump($_GET);
$id = $_GET['id'];
// var_dump($_GET);

// connexion à la BDD
require_once '../../../libraries/database.php';


// Requête sql récupérer id spécifique dans la BDD
$client = getClient($id);

// var_dump($client);


include '../../views/clients/edit_client.phtml';