<?php

require_once('view/LoginView.php');
require_once('model/UserLogIn.php');

class  LoginController {

  public function userLogin($username, $password) {
    try {
    $ul = new UserLogIn();
    $logInAttempt = $ul->userLogsIn($username, $password);
    } catch(PDOException $e) {
      echo $e->getMessage();
     return $logInAttempt;
    }
    return $logInAttempt;
  }
}
