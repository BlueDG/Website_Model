<?php

session_start();

$_SESSION['panier'] = [];

header('Location: index.php');
exit();