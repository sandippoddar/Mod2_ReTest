<?php
require_once './Database/Query.php';
require_once 'Validation.php';

if (isset($_POST["submit"])) {

  $obSignup = new Query();
  $obValid = new Validation();
  $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
  $email = $_POST['email'];
  $isExist = $obSignup->Duplicate($email);
  $errorArr = [];
  if (!$isExist) {
    $emailCheck = $obValid->isValidMail($email);
    $passCheck = $obValid->isPassword($_POST['password']);
    if (is_string($emailCheck)) {
      $errorArr[] = $emailCheck;
    }
    if (is_string($passCheck)) {
      $errorArr[] = $passCheck;
    }
  }
  if (is_string($isExist)) {
    $errorArr[] = $isExist;
  }
 
  if (empty($errorArr)) {
    session_destroy();
    $obSignup->insert($email, $_POST['type'], $password);
    header("location: /login");
  }
}