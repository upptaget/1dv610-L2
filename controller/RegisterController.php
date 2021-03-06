<?php

class  RegisterController {

  private $registerView;
  private $registerModel;

    public function __construct(RegisterView $rv, UserRegister $ur)
    {
      $this->registerView = $rv;
      $this->registerModel = $ur;
    }

  public function userRegister() {
    try{
      $passCheck = $this->checkPasswordsMatching();
      if($passCheck) {
        try {
       $this->registerModel->registerUser($this->getRegisterUsername(), $this->getRegisterPassword());
        } catch (Exception $e){
          $this->registerView->setMessage($e->getMessage());
        }

      }

    } catch(Exception $e) {
      $this->registerView->setMessage($e->getMessage());
    }
  }

  public function checkPasswordsMatching() {
    try {
    $this->registerView->checkRegistrationPasswordsMatch();
    return true;
    }
    catch(Exception $e) {
      $this->registerView->setMessage($e->getMessage());
      return false;
    }
  }

  public function getRegisterUsername() {
    try {
    return  $this->registerView->getRegisterUsername();
    } catch(Exception $e) {
      $this->registerView->setMessage($e->getMessage());
    }
  }

  public function getRegisterPassword() {
    try {
    return $this->registerView->getRegisterPassword();
    } catch(Exception $e) {
      $this->registerView->setMessage($e->getMessage());
    }
  }
}
