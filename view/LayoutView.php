<?php


class LayoutView {


  public function render($isRegistered, LoginView $lv, DateTimeView $dtv, RegisterView $rv, LoginController $lc) {
    $isLoggedIn = $lc->checkLogIn();

    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>MY Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->renderLink() . '
          ' . $this->renderIsLoggedIn($isLoggedIn) . '

          <div class="container">
              ' .$this->renderLoginOrRegister($isLoggedIn, $lv, $rv)  . '

              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }

  private function renderLink() {
    if(isset($_GET["register"])) {
      return '<a href="?">Back to login</a>';
    }
    return '<a href="?register">Register new user</a>';
}

  private function renderLoginOrRegister($isLoggedIn, LoginView $lv, RegisterView $rv) {

    if(isset($_GET["register"])) {
      return $rv->response();
    }
      return $lv->response($isLoggedIn);
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
