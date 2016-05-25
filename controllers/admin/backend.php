<?php
use \Library\fce;

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
		case 'stranky':
			include HOME_PATH . '/controllers/admin/stranky.php';
			$html->addToContent(include HOME_PATH . '/views/admin/navigation.php');
			return;
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
		case 'hlavicka':
			include HOME_PATH . '/controllers/admin/hlavicka.php';
			$html->addToContent(include HOME_PATH . '/views/admin/navigation.php');
			return;
			break;
		case 'paticka':
			include HOME_PATH . '/controllers/admin/paticka.php';
			$html->addToContent(include HOME_PATH . '/views/admin/navigation.php');
			return;
			break;
	}
}

$html->addToContent(include HOME_PATH . '/views/admin/backend/home.php');

$html->addToContent(include HOME_PATH . '/views/admin/navigation.php');