<?php
define ('HOME_PATH', __DIR__);
session_start();

function __autoload($name) {
	include_once HOME_PATH . '/models/classes/' . $name .'.class.php';
}
include HOME_PATH . '/config/constants.php';
include HOME_PATH . '/models/library/functions.php';
if (file_exists(MYSQL_CONNECTION_CONFIG_PATH)) {
	include MYSQL_CONNECTION_CONFIG_PATH;
}

$html = new HTML();

if (!file_exists(INSTALL_LOCK)) {
	include HOME_PATH . '/controllers/install/form.php';
	print $html->getHTML();
	return;
}

if (isset($_GET['page']) && $_GET['page'] == 'admin') {
	if (isset($_SESSION['autoweb']) && $_SESSION['autoweb'] != '') {
		include HOME_PATH . '/controllers/admin/backend.php';
	} else {
		include HOME_PATH . '/controllers/admin/login.php';
	}
	print $html->getHTML();
	return;	
}