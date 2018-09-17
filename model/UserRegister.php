<?php
require_once('database.php');

class UserRegister {

  public function registerUser($username, $password, $confpassword) {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $db = new Database();
    $sql = "INSERT INTO users (name, password) VALUES (:name, :password)";
    $temp = $db->connectToDatabase();
    $stmt = $temp->prepare($sql);
    $stmt->bindParam(':name', $username);
    $stmt->bindParam(':password', $hashedPassword);
    try {
    $stmt->execute();
    echo 'haha de gick';
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
  }
}
