<?php
    class Database {



    public function connectToDatabase () {
      $server = "localhost";
      $user = "test";
      $pass = "test";
      $database = "auth";

      try {
			 return $connection = new PDO("mysql:host=$server;dbname=$database;", $user, $pass);
			  echo 'connection!';
		  }
		  catch(PDOException $e) {
			  $message = $e->getMessage();
			  echo 'Connection failed';
      }
    }
  }
