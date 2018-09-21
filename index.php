<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');

require_once('controller/RegisterController.php');
require_once('controller/LoginController.php');

require_once('model/UserRegister.php');
require_once('model/UserLogIn.php');
require_once('model/database.php');


//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

session_start();

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView();
$dtv = new DateTimeView();
$rv = new RegisterView();
$lv = new LayoutView();
$rm = new UserRegister();
$lm = new UserLogIn();
$rc = new RegisterController($rv, $rm);
$lc = new LoginController($v, $lm);

if(isset($_POST["RegisterView::Register"])) {
  $rc->userRegister();
}

if(isset($_POST["LoginView::Login"])) {
  $lc->userLogin();
}

if(isset($_POST["LoginView::Logout"])) {
    if(isset($_SESSION["logged_in"])) {
      $v ->setMessage('Bye bye!');
      session_unset();
      session_destroy();
      }

}

$lv->render($v, $dtv, $rv, $lc, $rc);
