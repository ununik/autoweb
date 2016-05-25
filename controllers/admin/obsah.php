<?php
if (!isset($_GET['id']) || $_GET['id']=="") {
	return;
}
$page = new Page();
$obsah = new Obsah();
$pageValues = $page->getPage($_GET['id']);
if (!isset($pageValues['id'])) {
	return;
}
if (isset($_GET['part'])) {
	switch ($_GET['part']) {
		case 'new':
			$html->addToContent(include HOME_PATH . '/views/admin/backend/obsah/new.php');
			return;
			break;
		case 'new_type':
			include HOME_PATH . '/controllers/admin/obsah/type/all.php';
			return;
			break;
		case 'upr':
			include HOME_PATH . '/controllers/admin/obsah/upr.php';
			return;
			break;
	}
}

//PORADI
if (isset($_POST['nahoru']) || isset($_POST['dolu'])) {
	if (isset($_POST['nahoru']) && count($_POST['nahoru']) > 0) {
		foreach ($_POST['nahoru'] as $id=>$emptyValue) {
			$obsah->moveUp($id);
			header('Location: http://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		}
	}
	if (isset($_POST['dolu']) && count($_POST['dolu']) > 0) {
		foreach ($_POST['dolu'] as $id=>$emptyValue) {
			$obsah->moveDown($id);
			header('Location: http://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		}
	}
}
//SMAZAT
if (isset($_POST['delete'])) {
	if (count($_POST['delete']) > 0) {
		foreach ($_POST['delete'] as $id=>$emptyValue) {
			$obsah->delete($id);
			header('Location: http://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		}
	}
}

$html->addToContent(include HOME_PATH . '/views/admin/backend/obsah/home.php');