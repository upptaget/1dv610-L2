<?php

class DateTimeView {


	public function show() {

		  $timeString = date('l, \t\h\e jS \of F Y, \T\h\e \t\i\m\e \i\s h:i:s A');

			return '<p>' . $timeString . '</p>';
	}
}
