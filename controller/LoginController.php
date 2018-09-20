<?php

require_once('view/LoginView.php');
require_once('model/UserLogIn.php');

class  LoginController {

  private $loginView;
  private $loginModel;
  private $isLoggedIn = false;
  private $logInAttempt = false;

  public function __construct (LoginView $lv, UserLogIn $lm) {
    $this->loginView = $lv;
    $this->loginModel = $lm;
  }


  public function userLogin() {
    try {
      $this->logInAttempt = $this->loginModel->userLogsIn($this->loginView->getRequestUserName(), $this->loginView->getRequestPassword());

      if($this->logInAttempt) {
        $this->isLoggedIn = true;
      }

    } catch(PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function checkLogIn() {
    return $this->isLoggedIn;
  }
}
