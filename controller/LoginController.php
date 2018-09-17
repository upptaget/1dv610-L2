<?php

require_once('view/LoginView.php');
require_once('model/UserLogIn.php');

class  LoginController {

  public function userLogin($username, $password) {
    $ul = new UserLogIn();
    $ul->userLogsIn($username, $password);
  }
}
