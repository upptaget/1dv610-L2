<?php
require_once('database.php');

class UserRegister {

  public function registerUser($username, $password, $confpassword) {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $db = new Database();
    $connection = $db->connectToDatabase();

    $selection = $connection->prepare('SELECT id,name,password FROM users WHERE name = :name');
		$selection->bindParam(':name', $username);
		$selection->execute();
    $match = $selection->fetch(PDO::FETCH_ASSOC);

    if(!$match) {
    $sql = "INSERT INTO users (name, password) VALUES (:name, :password)";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':name', $username);
    $stmt->bindParam(':password', $hashedPassword);
    try {
    $stmt->execute();
    return true;
    }
    catch(PDOException $e) {
      return false;
    }
    } else {
      return false;
    }




  }
}
