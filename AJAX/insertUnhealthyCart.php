<?php

require_once __DIR__.'/../Database/Query.php';
require_once __DIR__.'/../Dashboard/dashboardSession.php';

$queryOb = new Query();
$quantity = $_POST['quantity'];
$id = $_POST['id'];
$user = $_SESSION['userEmail'];

$queryOb->insertUnhealthyCart($user, $id, $quantity);
