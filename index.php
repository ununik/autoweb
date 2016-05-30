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

//FRONT_END

if (isset($_GET['pid'])) {
	$pid = $_GET['pid'];
} else {
	$pid = '';
}

$page = new Page();
$actualPageSettings = $page->getActualPage($pid);

if (!isset($actualPageSettings['id']) && isset($_SESSION['autoweb']) && $_SESSION['autoweb'] != '') {
	$actualPageSettings = $page->getPage($pid);	
	if (!isset($actualPageSettings['id'])) {
		$html->addToContent('<h1>Tato sránka neexistuje</h1>');
	} else {
		$html->addToContent('<h1>Neaktivní stránka</h1>');
	}
} else if (!isset($actualPageSettings['id'])) {
	$html->addToContent('<h1>Tato sránka neexistuje</h1>');
}

if (file_exists(CSS_FRONTEND)) {
	$html->addCssFile('css/all.css');	
}

// FE HEADER
$html->generateFEHeader(1);
$html->generateFETitle($actualPageSettings['title']);

//CONTENT
//headline
$html->addToContent('<h1>'. $actualPageSettings['headline'] .'</h1>');
//contentboxes
include HOME_PATH . '/controllers/content.php';


//FE FOOTER
$html->generateFEFooter();
print $html->getHTML();