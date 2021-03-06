<?php

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	private $message = '';



	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response($isLoggedIn) {

		try {
			if($isLoggedIn) {

				$this->message = 'Welcome';
				$response = $this->generateLogoutButtonHTML($this->message);

				return $response;
			}
	}

	catch(Exception $e) {
		$response = $this->generateLoginFormHTML($e->getMessage());
		return $response;
	}


	$response = $this->generateLoginFormHTML($this->message);
		return $response;
}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		return '
			<form method="post" >
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>

					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="'. $this->displayUsername() . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />

					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}

	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	public function getRequestUserName() {
		if (empty($_POST[self::$name])) {
			throw new Exception('Username is missing');
		}
		return $_POST[self::$name];
	}

	public function getRequestPassword() {
		if (empty($_POST[self::$password])) {
			throw new Exception('Password is missing');
		}
		return $_POST[self::$password];
	}

	public function setMessage($message) {
		$this->message = $message . '<br>';
	}

	public function getMessage() {
		return $this->message;
	}

	private function displayUsername() {
		if(isset($_POST[self::$name])) {
			return $_POST[self::$name];
		} else {
			return '';
		}
	}
}
