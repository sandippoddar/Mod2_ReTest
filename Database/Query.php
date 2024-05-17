<?php

require_once __DIR__ . '/../Database/Connection.php';

/**
 * This class Implements all Database Queries that we have Used.
 */
class Query extends Connection {

  /**
   * This constructor use here to invoke parent class constructor.
   */
  public function __construct() {
    parent::__construct();
  }

  /**
   * Function to insert records when new User registered.
   * 
   * @param string $userName
   *  Stores Username of new User.
   * @param string $email
   *  Stores Email Id of new User.
   * @param string $password
   *  Stores Password in hash format.
   * 
   * @return void
   */
  public function insert(string $email, string $type, string $password) {
    $sql = $this->conn->prepare("INSERT INTO User (Email, User_type, Password) VALUES(:email, :type, :password)");
    $sql->execute(array(':email' => $email, ':type' => $type, ':password' => $password));
  }

  /**
   * Function to check if Username or Email is already in the Database or not.
   * 
   * @param string $email
   *  Store Email Id of User.
   * 
   * @return string|bool
   *  This function returns String when Email is in Database and returns False 
   *  when Email is not in the Database.
   */
  public function Duplicate (string $email) {
    $sql = $this->conn->prepare("SELECT * FROM User WHERE Email = :email");
    $sql->execute(array(':email' => $email));
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    if ($result != []) {
      return 'Email has already Taken!!';
    }
    return False;
  }

  /**
   * Function to Check if the Email ID is already in the Database or not.It is 
   * using in Reset Password feature to send Reset Password Link.
   * 
   * @param string $userEmail
   *  Stores Email ID of the User.
   * 
   * @return bool
   *  This function return TRUE if Email ID is in the Database or return FALSE
   *  if Email ID is not in the Database.
   */
  public function isEmailInDb (string $userEmail) {
    $sql = $this->conn->prepare("SELECT * FROM User WHERE Email = :userEmail");
    $sql->execute([':userEmail' => $userEmail]);
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    if ($result != []) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Function to Login user by checking the Email ID is Already
   * stored in the Database or not.
   * 
   * @param string $userEmail
   *  Stores the Data as per the User enter Username or Email.
   * 
   * @return array|bool
   *  This Function return Password of the User which Email is in the Database 
   *  or return False if User's Email is not in Database.
   */
  public function LoginSelect (string $userEmail) {
    $sql = $this->conn->prepare("SELECT * FROM User WHERE Email = :Email");
    $sql->execute(array(':Email' => $userEmail));
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    if ($result != []) {
      return [$result['Password'],$result['User_type']];
    }
    return FALSE;
  }

  /**
   * Function to implement Insert stock records.
   * 
   * @param string $name
   *  Stores Stock Name.
   * @param int $price
   *  Stores Price Of the Stock.
   * 
   * @return void
   */
  public function insertHealthyProduct(string $name, int $price) {
    $sql = $this->conn->prepare("INSERT INTO healthy_product (Name, Price) VALUES(:name, :price)");
    $sql->execute(array(':name' => $name, ':price' => $price));
  }

  /**
   * Function to implement Insert stock records.
   * 
   * @param string $name
   *  Stores Stock Name.
   * @param int $price
   *  Stores Price Of the Stock.
   * 
   * @return void
   */
  public function insertUnhealthyProduct(string $name, int $price) {
    $sql = $this->conn->prepare("INSERT INTO unhealthy_product (Name, Price) VALUES(:name, :price)");
    $sql->execute(array(':name' => $name, ':price' => $price));
  }

  /**
   * Function to fetch Stock details for a particular User.
   * 
   * @return array
   *  Array contains Stock Details of a the Email User.
   */
  public function fetchHealthyProduct() {
    $sql = $this->conn->prepare("SELECT * FROM healthy_product");
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

   /**
   * Function to fetch Stock details for a particular User.
   * 
   * @return array
   *  Array contains Stock Details of a the Email User.
   */
  public function fetchUnhealthyProduct() {
    $sql = $this->conn->prepare("SELECT * FROM unhealthy_product");
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  /**
   * Function to implement insert record in Health cart Table.
   * 
   * @param string $user
   *  Stores User Email of User.
   * @param int $id
   *  Stores Id.
   * @param int $quantity
   *  Stores Quantity.
   * 
   * @return void
   */
  public function insertHealthyCart(string $user, int $id, int $quantity) {
    $sql = $this->conn->prepare("INSERT INTO cartHealthy (User, Product_id, quantity) VALUES ('$user', $id, $quantity)");
    $sql->execute();
  }

  /**
   * Function to implement insert record in Health cart Table.
   * 
   * @param string $user
   *  Stores User Email of User.
   * @param int $id
   *  Stores Id.
   * @param int $quantity
   *  Stores Quantity.
   * 
   * @return void
   */
  public function insertUnhealthyCart(string $user, int $id, int $quantity) {
    $sql = $this->conn->prepare("INSERT INTO cartUnhealthy (User, Product_id, quantity) VALUES ('$user', $id, $quantity)");
    $sql->execute();
  }

  /**
   * Function to get Sum of Price of Healthy Products.
   * 
   * @param string $email
   *  Stores Email of user.
   * 
   * @return array
   */
  public function sumHealthyCart (string $email) {
    $sql = $this->conn->prepare("SELECT SUM(A.Price) AS SUM FROM healthy_product AS A JOIN cartHealthy AS B ON A.Id = B.Product_id WHERE B.User = '$email'");
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  /**
   * Function to get Sum of Price of Healthy Products.
   * 
   * @param string $email
   *  Stores Email of user.
   * 
   * @return array
   */
  public function sumUnhealthyCart (string $email) {
    $sql = $this->conn->prepare("SELECT SUM(A.Price) AS SUM FROM unhealthy_product AS A JOIN cartUnhealthy AS B ON A.Id = B.Product_id WHERE B.User = '$email'");
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    return $result;
  }
}
