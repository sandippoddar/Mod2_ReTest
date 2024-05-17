<?php

require_once './Database/Query.php';
require_once __DIR__.'/../Dashboard/dashboardSession.php';
require_once 'Validation.php';

$queryOb = new Query();
$validOb = new Validation();

if (isset($_POST['submit'])) {

  $nameCheck = $validOb->alphabetsOnly($_POST['name']);
  $priceCheck = $validOb->numbersOnly($_POST['price']);
  $errorName = [];
  if (empty($_POST['name'])) {
    $errorName[] = 'Product Name cannot be Empty.';
  }
  else if (is_string($nameCheck)) {
    $errorName[] = $nameCheck;
  }

  $errorPrice = [];
  if (empty($_POST['price'])) {
    $errorPrice[] = 'Product Price cannot be Empty.';
  }
  else if (is_string($priceCheck)) {
    $errorPrice[] = $priceCheck;
  }

  if (empty($errorName) && empty($errorPrice)) {
    $queryOb->insertHealthyProduct($_POST['name'], $_POST['price']);
  }
}
