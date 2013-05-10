<?php

session_start();

require_once('startup.php');

if(!is_session()) {
	include 'login_form.php';
}

// Access database and create connection resource
$dbcreds = array(
	'name' => 'uastutorial',
	'host' => 'localhost',
	'user' => 'UASTutorial',
	'pass' => 'uas_tutorial'
);

$conn = database_connection_setup($dbcreds);

if($_POST && !is_session()) {
	validate_login($conn);
}

$page = $_GET['page'];

switch($page) {
	case 'about':
		include "pages/about.html";
	break;
	case 'contact':
		include "pages/contact.html";
	break;
	case 'members_only':
		if(is_session()) {
			return 'pages/members_only.html';
		} else {
			return 'pages/403forbidden.html';
		}
	break;
	default:
		include "pages/home.html";
	break;
	
}

?>

<?php if(is_session()): ?>
	<h2>You are now logged in!</h2>
<?php endif; ?>