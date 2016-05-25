<?php
$container = '<h1>Nastavení hlavičky webu</h1>';
$container .= '<p>Celá patička má ve FE <u>id="<i>footer</i>"</u>.</p>';

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
$container .= '<label for="class">Název třídy</label>';
$container .= '<p>Název třídy, který se používá v CSS (př. mojeTrida => class="<i>mojeTrida</i>")</p>';
$container .= '<input type="text" name="class"  id="class" value="' . $class . '">';
$container .= '</div>';	

$container .= '<div class="form_input">';
$container .= '<label for="text">Obsah patičky</label>';
$container .= '<p>Tento text se objevuje v jednom bloku patičky - je možnost použít zde i html tagy (DOM: class="<i>mojeTrida</i>" - viz pole výše)</p>';
$container .= '<textarea id="text" name="text">' . $text . '</textarea>';
$container .= '</div>';

$container .= '<input type="submit" value="Uložit" name="patickaForm">';

$container .= '</form>';
$container .= '</div>';

return $container;