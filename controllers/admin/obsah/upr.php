<?php
if (!isset($_GET['contentId'])) {
	return;
}
$html->addToScripts('<script src="models/library/tinymce/js/tinymce/tinymce.min.js"></script>');
$actualContent = $obsah->getContent($_GET['contentId']);
if (!isset($actualContent['id'])) {
	return;
}
$err = array();
$title = $actualContent['title'];
$class = $actualContent['class'];
$text = $actualContent['text'];

if ($actualContent['type'] == 'calendar') {
    $calendarContent = $obsah->getCalendarType($actualContent['id']);
    
    $type = $calendarContent['type'];
    $specification = $calendarContent['specification'];
}


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

		$obsah->uprContent($_GET['contentId'], $title, '', $class);
		header('Location: ?page=admin&action=obsah&id='.$_GET['id']);
	}
}
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
			
		$obsah->uprContent($_GET['contentId'], $title, $text, $class);
		header('Location: ?page=admin&action=obsah&id='.$_GET['id']);
	}
}

if (isset($_POST['calendarForm'])) {
    $title = \Library\fce\safeText($_POST['title']);
    $class = \Library\fce\safeText($_POST['class']);
    $type = \Library\fce\safeText($_POST['type']);
     
    if (strlen($title) > 255) {
        $err[] = 'Příliš dlouhý titulek';
    }
    if (strlen($class) > 255) {
        $err[] = 'Příliš dlouhý název třídy.';
    }
    if (strlen($type) == 0) {
        $err[] = 'Není vybraný typ kalendáře.';
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

        $obsah->uprContent($_GET['contentId'], $title, '', $class);
        $obsah->updateCalendarType($_GET['contentId'], $type, $specification);
         
        header('Location: ?page=admin&action=obsah&id='.$_GET['id']);
    }
}

$html->addToContent(include HOME_PATH . '/views/admin/backend/obsah/type/'.$actualContent['type'].'.php');
