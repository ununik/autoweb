<?php
$err = array();
$title = '';
$subtitle = '';
$description = '';

$header = new Header();
$headerParts = $header->getHeaderPartsForId(1);
if (count($headerParts) > 0) {
	$title = $headerParts['header_mainTitle'];
	$subtitle = $headerParts['header_subTitle'];
	$description = $headerParts['header_text'];
}

if (isset($_POST['hlavickaForm'])) {
	$title = \Library\fce\safeText($_POST['title']);
	$subtitle = \Library\fce\safeText($_POST['subtitle']);
	$description = $_POST['description'];
	
	if (strlen($title) > 255) {
		$err[] = 'Příliš dlouhý titulek.';
	}
	if (strlen($subtitle) > 255) {
		$err[] = 'Příliš dlouhý podtitulek.';
	}
	
	if (count($err) == 0) {
		$result = Connection::connect()->prepare(
				'
					INSERT INTO `header_autoweb` (`id`,`header_mainTitle`, `header_subTitle`, `header_text`) VALUES (1, :title, :subtitle, :description)
					ON DUPLICATE KEY UPDATE `header_mainTitle`=:title, `header_subTitle`=:subtitle, `header_text`=:description;
				'
		);
		$result->execute(array(
				':title' => $title,
				':subtitle' => $subtitle,
				':description' => $description
		));
		header('Location: http://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
	}
}

$html->addToContent(include HOME_PATH . '/views/admin/backend/hlavicka/home.php');