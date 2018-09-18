<?php

require_once('database.php');

class UserLogIn {

  public function userLogsIn($username, $password) {
		$db = new Database();
		$connection = $db->connectToDatabase();
		$selection = $connection->prepare('SELECT id,name,password FROM users WHERE name = :name');
		$selection->bindParam(':name', $username);
		$selection->execute();
		$match = $selection->fetch(PDO::FETCH_ASSOC);

		if(count($match) > 0 && password_verify($password, $match['password'])) {
			return true;
		} else {
			return false;
		}
  }
}
