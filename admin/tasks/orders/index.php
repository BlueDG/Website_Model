<?php

// connexion à la BDD
require_once '../../../libraries/database.php';


$orders = getOrders();


// inclusion du phtml
include '../../views/orders/list.phtml';