<?php

require_once('database.php');
session_start();

class UserLogIn {

  public function userLogsIn($username, $password) {
		$db = new Database();
		$connection = $db->connectToDatabase();
		$selection = $connection->prepare('SELECT id,name,password FROM users WHERE name = :name');
		$selection->bindParam(':name', $username);
		$selection->execute();
		$match = $selection->fetch(PDO::FETCH_ASSOC);

		if($match && password_verify($password, $match['password'])) {
			$_SESSION['user_id'] = $match['id'];
			return true;
		} else {
			return false;
		}
  }
}
