<?php


class LayoutView {

  public function render($isLoggedIn, $register, LoginView $lv, DateTimeView $dtv, RegisterView $rv) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>MY Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->renderLink($register) . '
          ' . $this->renderIsLoggedIn($isLoggedIn) . '

          <div class="container">
              ' .$this->renderLoginOrRegister($register, $lv, $rv)  . '

              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }

  private function renderLink($register) {
    if(!$register) {
    return '<a href="?register">Register</a>';
    }
    return '<a href="?">Login</a>';
  }

  private function renderLoginOrRegister($register, LoginView $lv, RegisterView $rv) {
    if ($register) {
      return $rv->response();
    }
    else {
      return $lv->response();
    }
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
