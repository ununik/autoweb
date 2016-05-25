<?php
$page = new Page();
if (isset($_GET['part'])) {
	$err = array();
	switch($_GET['part']) {
		case 'new':			
			$headline = '';
			$title = '';
			$metaDescription = '';
			
			if (isset($_POST['pageForm'])) {
				$headline = \Library\fce\safeText($_POST['headline']);
				$title = \Library\fce\safeText($_POST['title']);
				$metaDescription = \Library\fce\safeText($_POST['meta_description']);
				
				if (strlen($headline) > 255) {
					$err[] = 'Příliš dlouhý nadpis.';
				}
				if (strlen($title) > 255) {
					$err[] = 'Příliš dlouhý titulek.';
				}
				
				if (count($err) == 0) {
					if (!isset($_GET['parent'])) {
						$parent = 0;
					} else {
						$parent = $_GET['parent'];
					}
					
					if (!isset($_GET['position'])) {
						$position = '';
					} else {
						$position = $_GET['position'];
					}
					
					$page->saveNew($headline, $title, $metaDescription, $parent, $position);
					header('Location: ?page=admin&action=stranky');
				}
			}
			$html->addToContent(include HOME_PATH . '/views/admin/backend/stranky/pageForm.php');
			return;
		case 'upr':
			if (!isset($_GET['id'])) {
				continue;
			}
			$pageValue = $page->getPage($_GET['id']);
			if (count($pageValue) == 0) {
				continue;
			}
			$headline = $pageValue['headline'];
			$title = $pageValue['title'];
			$metaDescription = $pageValue['meta_description'];
				
			if (isset($_POST['pageForm'])) {
				$headline = \Library\fce\safeText($_POST['headline']);
				$title = \Library\fce\safeText($_POST['title']);
				$metaDescription = \Library\fce\safeText($_POST['meta_description']);
		
				if (strlen($headline) > 255) {
					$err[] = 'Příliš dlouhý nadpis.';
				}
				if (strlen($title) > 255) {
					$err[] = 'Příliš dlouhý titulek.';
				}
		
				if (count($err) == 0) {						
					$page->saveUpr($headline, $title, $metaDescription, $_GET['id']);
					header('Location: ?page=admin&action=stranky');
				}
			}
			$html->addToContent(include HOME_PATH . '/views/admin/backend/stranky/pageForm.php');
			return;
	}
}

//SKRYTI
if (isset($_POST['hide']) || isset($_POST['unhide'])) {
	if (count($_POST['hide']) > 0) {
		foreach ($_POST['hide'] as $id=>$emptyValue) {
			$page->hide($id);
			header('Location: http://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		}
	}
	if (count($_POST['unhide']) > 0) {
		foreach ($_POST['unhide'] as $id=>$emptyValue) {
			$page->unhide($id);
			header('Location: http://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		}
	}
}

//SMAZAT
if (isset($_POST['delete'])) {
	if (count($_POST['delete']) > 0) {
		foreach ($_POST['delete'] as $id=>$emptyValue) {
			$page->delete($id);
			header('Location: http://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		}
	}
}

//PORADI
if (isset($_POST['nahoru']) || isset($_POST['dolu'])) {
	if (isset($_POST['nahoru']) && count($_POST['nahoru']) > 0) {
		foreach ($_POST['nahoru'] as $id=>$emptyValue) {
			$page->moveUp($id);
			header('Location: http://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		}
	}
	if (isset($_POST['dolu']) && count($_POST['dolu']) > 0) {
		foreach ($_POST['dolu'] as $id=>$emptyValue) {
			$page->moveDown($id);
			header('Location: http://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		}
	}
}

$html->addToContent(include HOME_PATH . '/views/admin/backend/stranky/basic.php');