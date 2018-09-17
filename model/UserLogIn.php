<?php

class UserLogIn {

  public function userLogsIn($username, $password) {
    $server = "localhost";
		$user = "test";
		$pass = "test";
		$database = "auth";
		try {
			$connection = new PDO("mysql:host=$server;dbname=$database;", $user, $pass);
			echo 'connection!';
		}
		catch(PDOException $e) {
			$message = $e->getMessage();
			echo 'Connection failed';
		}
  }
}
