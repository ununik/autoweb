<?php
if (!isset($_GET['type'])) {
	return;
}
$err = array();
$obsah = new Obsah();

switch($_GET['type']) {
	case 'wrapper':
		$title = '';
		$class = '';
		
		if (isset($_POST['wrapperForm'])) {
			$title = \Library\fce\safeText($_POST['title']);
			$class = \Library\fce\safeText($_POST['class']);
			
			if (strlen($title) > 255) {
				$err[] = 'Příliš dlouhý titulek';
			}
			if (strlen($class) > 255) {
				$err[] = 'Příliš dlouhý název třídy.';
			}
			
			if (count($err) == 0) {
				$parent = 0;
				if (isset($_GET['parent'])) {
					$parent = $_GET['parent'];
				}
				$order = 0;
				if (isset($_GET['order'])) {
					$order = $_GET['order'];
				}
				
				$obsah->saveNewContent($_GET['id'], 'wrapper', $parent, $order, $title, '', $class);
				header('Location: ?page=admin&action=obsah&id='.$_GET['id']);
			}
		}
		$html->addToContent(include HOME_PATH . '/views/admin/backend/obsah/type/wrapper.php');
		return;
		break;
		
	case 'text':
		
		$title = '';
		$class = '';
		$text = '';
		
		if (isset($_POST['textForm'])) {
			$title = \Library\fce\safeText($_POST['title']);
			$class = \Library\fce\safeText($_POST['class']);
			$text = $_POST['text'];
				
			if (strlen($title) > 255) {
				$err[] = 'Příliš dlouhý titulek';
			}
			if (strlen($class) > 255) {
				$err[] = 'Příliš dlouhý název třídy.';
			}
				
			if (count($err) == 0) {
				$parent = 0;
				if (isset($_GET['parent'])) {
					$parent = $_GET['parent'];
				}
				$order = 0;
				if (isset($_GET['order'])) {
					$order = $_GET['order'];
				}
			
				$obsah->saveNewContent($_GET['id'], 'text', $parent, $order, $title, $text, $class);
				header('Location: ?page=admin&action=obsah&id='.$_GET['id']);
			}
		}
		
		$html->addToScripts('<script src="models/library/tinymce/js/tinymce/tinymce.min.js"></script>');
		$html->addToContent(include HOME_PATH . '/views/admin/backend/obsah/type/text.php');
		return;
		break;
	case 'kalendar':
		$html->addToScripts('<script src="models/library/tinymce/js/tinymce/tinymce.min.js"></script>');
		$html->addToContent(include HOME_PATH . '/views/admin/backend/obsah/type/kalendar.php');
		return;
		break;
}

$html->addToContent(include HOME_PATH . '/views/admin/backend/obsah/type/all.php');