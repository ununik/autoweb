<?php
use \Library\fce;

$html->addCssFile('css/admin.css');

$html->addToContent('<div id="baseHeadline"><h1>Autoweb</h1><div>autor: Martin Přibyl</div><div>verze: 0.01</div></div>');

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
		case 'menu':
			$html->addToContent(include HOME_PATH . '/views/admin/navigation.php');
			include HOME_PATH . '/controllers/admin/menu.php';
			return;
			break;
		case 'stranky':
			$html->addToContent(include HOME_PATH . '/views/admin/navigation.php');
			include HOME_PATH . '/controllers/admin/stranky.php';
			return;
			break;
		case 'obsah':
			$html->addToContent(include HOME_PATH . '/views/admin/navigation.php');
			include HOME_PATH . '/controllers/admin/obsah.php';
			return;
			break;
		case 'web':
			$html->addToContent(include HOME_PATH . '/views/admin/navigation.php');
			include HOME_PATH . '/controllers/admin/web.php';
			return;
			break;
		case 'hlavicka':
			$html->addToContent(include HOME_PATH . '/views/admin/navigation.php');
			include HOME_PATH . '/controllers/admin/hlavicka.php';
			return;
			break;
		case 'paticka':
			$html->addToContent(include HOME_PATH . '/views/admin/navigation.php');
			include HOME_PATH . '/controllers/admin/paticka.php';
			return;
			break;
	}
}

$html->addToContent(include HOME_PATH . '/views/admin/navigation.php');
$html->addToContent(include HOME_PATH . '/views/admin/backend/home.php');