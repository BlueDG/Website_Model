<?php

$id = $_GET['id'];

// connexion BDD
require_once '../../../libraries/database.php';

// requête de type DELETE
deleteClient($id);

header('Location: index_client.php');
exit();
