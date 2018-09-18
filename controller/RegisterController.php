<?php

require_once('view/LoginView.php');
require_once('model/UserRegister.php');

class  RegisterController {

  public function userRegister($password, $username) {
    $ur = new UserRegister();
    $registerAttempt = $ur->registerUser($username, $password);
    return $registerAttempt;

  }
}
