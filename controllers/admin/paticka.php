<?php
$footer = new Footer();
if (isset($_GET['part']) && $_GET['part']!='') {
	$err = array();
	$class = '';
	$text = '';
	
	switch ($_GET['part']) {
		case 'new':
			if (isset($_POST['patickaForm'])) {
				$class = \Library\fce\safeText($_POST['class']);
				$text = $_POST['text'];
				
				if (strlen($class) > 255) {
					$err[] = 'Název třídy je příliš dlouhý.';
				}
				
				if (count($err) == 0) {
					$footer->saveNewToDb($class, $text);
					header('Location: ?page=admin&action=paticka');
				}
			}
			$html->addToContent(include HOME_PATH . '/views/admin/backend/paticka/form.php');
			return;
			break;
		case 'update':
			if (!isset($_GET['id']) || $_GET['id']=="") {
				continue;
			}
			$fv = $footer->getOneBlock($_GET['id']);
			if (!isset($fv['id'])) {
				continue;
			}
			
			$class = $fv['footer_class'];
			$text = $fv['footer_text'];
			
			if (isset($_POST['patickaForm'])) {
				$class = \Library\fce\safeText($_POST['class']);
				$text = $_POST['text'];
			
				if (strlen($class) > 255) {
					$err[] = 'Název třídy je příliš dlouhý.';
				}
			
				if (count($err) == 0) {
					$footer->saveUpdateToDb($class, $text, $_GET['id']);
					header('Location: ?page=admin&action=paticka');
				}
			}
			$html->addToContent(include HOME_PATH . '/views/admin/backend/paticka/form.php');
			return;
			break;
	}
}
//PORADI
if (isset($_POST['nahoru']) || isset($_POST['dolu'])) {
	if (count($_POST['nahoru']) > 0) {
		foreach ($_POST['nahoru'] as $id=>$emptyValue) {
			$footer->moveUp($id);
			header('Location: http://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		}
	}
	if (count($_POST['dolu']) > 0) {
		foreach ($_POST['dolu'] as $id=>$emptyValue) {
			$footer->moveDown($id);
			header('Location: http://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		}
	}
}
//SKRYTI
if (isset($_POST['hide']) || isset($_POST['unhide'])) {
	if (count($_POST['hide']) > 0) {
		foreach ($_POST['hide'] as $id=>$emptyValue) {
			$footer->hide($id);
			header('Location: http://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		}
	}
	if (count($_POST['unhide']) > 0) {
		foreach ($_POST['unhide'] as $id=>$emptyValue) {
			$footer->unhide($id);
			header('Location: http://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		}
	}
}

//SMAZAT
if (isset($_POST['delete'])) {
	if (count($_POST['delete']) > 0) {
		foreach ($_POST['delete'] as $id=>$emptyValue) {
			$footer->delete($id);
			header('Location: http://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		}
	}
}

$html->addToContent(include HOME_PATH . '/views/admin/backend/paticka/home.php');