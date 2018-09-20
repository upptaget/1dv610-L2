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
      $this->logInAttempt = $this->loginModel->userLogsIn($this->getLoginUserName(), $this->getLoginPassword());

      if($this->logInAttempt) {
        $this->isLoggedIn = true;
      } else {
        $message = $this->loginView->getMessage();
        if($message == '') {
        $this->loginView->setMessage('Wrong name or password');
        }
      }

    } catch(PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function getLoginUsername() {
    try {
    return  $this->loginView->getRequestUsername();
    } catch(Exception $e) {
      $this->loginView->setMessage($e->getMessage());
    }
  }

  public function getLoginPassword() {
    try {
    return $this->loginView->getRequestPassword();
    } catch(Exception $e) {
      $message = $this->loginView->getMessage();
      if($message == '') {
      $this->loginView->setMessage($e->getMessage());
      }
    }
  }

  public function checkLogIn() {
    return $this->isLoggedIn;
  }
}
