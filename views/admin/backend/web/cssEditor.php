<?php
$container = '<h2>Editace CSS</h2>';
$container .= '<div id="form_wrapper">';

if (count($err) > 0) {
	$container .= '<ul>';
	foreach ($err as $error) {
		$container .= '<li>' . $error . '</li>';
	}
	$container .= '</ul>';
}

$container .= '<form action="" method="post">';

$container .= '<div class="form_input">';
$container .= '<label for="css">Soubor CSS</label>';
$container .= '<p>Tento soubor se používá pro designovou stránku webu. Zde můžete pomocí css nastavovat cokoliv, týkající se vzhledu. (např. <u>page{background-color: blue;}</u>)</p>';
$container .= '<textarea id="css" name="css" class="long_textarea">' . $css . '</textarea>';
$container .= '</div>';

$container .= '<input type="submit" value="Uložit" name="cssForm">';

$container .= '</form>';
$container .= '</div>';

return $container;