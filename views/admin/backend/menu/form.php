<?php
$container = '<h1>Nastavení Menu</h1>';
$container .= '<p>Celé menu má ve FE <u>id="<i>navigation</i>"</u>.</p>';

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
$container .= '<label for="class">Titulek</label>';
$container .= '<input type="text" name="class"  id="class" value="">';
$container .= '</div>';	

$container .= '<div class="form_input">';
$container .= '<label for="text">Odkaz na stránku webu</label>';
$container .= '<p>Zde se uvede id stránky nebo celá url</p>';
$container .= '<input type="text" name="class"  id="class" value="">';
$container .= '</div>';

$container .= '<input type="submit" value="Uložit" name="patickaForm">';

$container .= '</form>';
$container .= '</div>';

return $container;