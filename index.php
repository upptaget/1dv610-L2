<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

session_start();

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView();
$dtv = new DateTimeView();
$rv = new RegisterView();
$lv = new LayoutView();
$register = false;
$isLoggedIn = false;


if(isset($_GET["register"])) {
  $register = true;
}
if(isset($_SESSION["user_id"])) {
  $isLoggedIn = true;
}
  $lv->render($isLoggedIn, $register,  $v, $dtv, $rv);
