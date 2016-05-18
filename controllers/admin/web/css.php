<?php
use \Library\fce;
$err = array();

if (isset($_POST['cssForm'])) {
	$cssFile = fOpen(CSS_FRONTEND, 'w');
	fwrite($cssFile, $_POST['css']);
	fclose($cssFile);
}

if (!file_exists(CSS_FRONTEND)) {
	touch(CSS_FRONTEND);
}
$css = file_get_contents(CSS_FRONTEND);

$html->addToContent(include HOME_PATH . '/views/admin/backend/web/cssEditor.php');