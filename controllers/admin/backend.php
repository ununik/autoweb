<?php
$html->addCssFile('css/admin.css');

if (isset($_GET['action'])) {
	switch ($_GET['action']) {
		case 'akualizace':
			include HOME_PATH . '/models/library/importTables.php';
			header('Location: ?page=admin');
			break;
		case 'unlog':
			unset($_SESSION['autoweb']);
			header('Location: ?page=admin');
			break;
		case 'obsah':
			include HOME_PATH . '/controllers/admin/obsah.php';
			$html->addToContent(include HOME_PATH . '/views/admin/navigation.php');
			return;
			break;
		case 'web':
			include HOME_PATH . '/controllers/admin/web.php';
			$html->addToContent(include HOME_PATH . '/views/admin/navigation.php');
			return;
			break;
	}
}

$html->addToContent(include HOME_PATH . '/views/admin/backend/home.php');

$html->addToContent(include HOME_PATH . '/views/admin/navigation.php');