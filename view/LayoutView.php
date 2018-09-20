<?php


class LayoutView {


  public function render($isRegistered, LoginView $lv, DateTimeView $dtv, RegisterView $rv, LoginController $lc, RegisterController $rc) {
    $isLoggedIn = $lc->checkLogIn();
    $isRegistered = $rc->isRegistered();

    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>MY Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->renderLink($isRegistered) . '
          ' . $this->renderIsLoggedIn($isLoggedIn) . '

          <div class="container">
              ' .$this->renderLoginOrRegister($isLoggedIn, $isRegistered, $lv, $rv)  . '

              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }

  private function renderLink($isRegistered) {
    if(isset($_GET["register"]) && !$isRegistered) {
      return '<a href="?">Back to login</a>';
    }
    return '<a href="?register">Register a new user</a>';
}

  private function renderLoginOrRegister($isLoggedIn, $isRegistered, LoginView $lv, RegisterView $rv) {

    if($isLoggedIn) {
      return $lv->response($isLoggedIn, $isRegistered);
    }

    if(isset($_GET["register"]) && !$isRegistered) {
      return $rv->response();
    }
    if(isset($_POST["register"]) && !$isRegistered) {
      return $rv->response();
      }
    if($isRegistered) {
      return $lv->response($isLoggedIn, $isRegistered);
    }
    return $lv->response($isLoggedIn, $isRegistered);
  }

  private function renderIsLoggedIn($isLoggedIn) {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }
}
