<?php

function is_session(){
	if($_SESSION['mylogin'] == '12345') {
		return TRUE;
	} else {
		return FALSE;
	}
}

function database_connection_setup($dbcreds) {
	// Create database connection resource
	$conn = mysqli_connect($dbcreds['host'], $dbcreds['user'], $dbcreds['pass'], $dbcreds['name']);

	if(!$conn) {
		die("DATABASE IS BROKEN!!");
	}
	
	return $conn;
}

function validate_login($onn) {
	if(isset($_POST['username']) && isset($_POST['password'])) {
		$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '".$_POST['username']."'");
		
		if(!$result) {
			die('User not found!');
		}
		$user = mysqli_fetch_assoc($result);

		if($user['password'] == md5($_POST['password'])) {
			$_SESSION['mylogin'] = '12345';
		} else {
			die('INVALID PASSWORD!!');
		}
	}
}