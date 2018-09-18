<?php

require_once('controller/RegisterController.php');

class RegisterView {

  private static $name = 'RegisterView::UserName';
  private static $password = 'RegisterView::Password';
  private static $passwordRepeat = 'RegisterView::PasswordRepeat';
  private static $messageId = 'RegisterView::Message';
  private static $register = 'RegisterView::Register';

  public function response() {
    $message = '';
    try {
      if(!empty($_POST)) {
        $rc = new RegisterController();
        $tryRegister = $rc->userRegister($this->getRegisterUserName(), $this->getRegisterPassword(), '');
				if($tryRegister) {
				$message = 'Success!';
				} else {
					$message = 'Username already exists';
				}
      }
    }

    catch(Exception $e) {
      $response = $this->generateRegisterFormHTML($e->getMessage());
      return $response;
    }


			$response = $this->generateRegisterFormHTML($message);
		  return $response;


	}

private function generateRegisterFormHTML($message) {
		return '
			<form method="post" >
				<fieldset>
					<legend>Register new user - Enter username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>

					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="" />

					<label for="' . self::$password . '">Password :</label>
          <input type="password" id="' . self::$password . '" name="' . self::$password . '" />

          <label for="' . self::$passwordRepeat . '">Confirm Password :</label>
					<input type="password" id="' . self::$passwordRepeat . '" name="' . self::$passwordRepeat . '" />

					<input type="submit" name="' . self::$register . '" value="register" />
				</fieldset>
			</form>
		';
  }
  private function getRegisterUserName() {
		if (empty($_POST[self::$name])) {
			throw new Exception('Missing Username');
		} else if (strlen($_POST[self::$name]) < 2) {
			throw new Exception('Username must be at least 2 characters');
		}
		return $_POST[self::$name];
}
	private function getRegisterPassword() {
		if (empty($_POST[self::$password])) {
			throw new Exception('Missing Password');
		} else if ($_POST[self::$password] != $_POST[self::$passwordRepeat]) {
			throw new Exception('Passwords does not match');
		} else if (strlen($_POST[self::$password]) < 3) {
			throw new Exception('Password must be at least 3 characters');
		}
		return $_POST[self::$password];
	}
}
