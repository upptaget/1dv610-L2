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
        $tryRegister = $rc->userRegister($this->getRegisterPassword(), $this->getRegisterUserName());
				if($tryRegister) {
				$message = 'Success!';
				} else {
					$message = 'User exists, pick another username.';
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
		if(empty($_POST[self::$name]) || strlen($_POST[self::$name]) < 2) {
			throw new Exception('Username has too few characters, at least 3 characters.');
		}
		return $_POST[self::$name];
}
	private function getRegisterPassword() {
		if (empty($_POST[self::$password]) || strlen($_POST[self::$password]) < 6) {
			throw new Exception('Password has too few characters, at least 6 characters.');
		} else if ($_POST[self::$password] != $_POST[self::$passwordRepeat]) {
			throw new Exception('Passwords do not match.');
		}
		return $_POST[self::$password];
	}
}
