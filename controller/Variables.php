<?php

require_once('view/LoginView.php');

class  Variables {
  private $name;
  private $password;

  public function getName($username) {
    echo $username;
  }
}
