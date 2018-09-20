<?php

require_once('view/LoginView.php');
require_once('model/UserLogIn.php');

class  LoginController {

  private $isLoggedIn;

  public function userLogin($username, $password) {
    try {

      $ul = new UserLogIn();
      $logInAttempt = $ul->userLogsIn($username, $password);
      $this->isLoggedIn = true;
      return $this->isLoggedIn;


    } catch(PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function checkLogIn() {
    return $this->isLoggedIn;
  }
}
