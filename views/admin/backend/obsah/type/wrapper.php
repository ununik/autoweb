<?php
$container = '<h1>Výběr typu obsahu pro '.$pageValues['headline'].'</h1>';
$container .= '<h2>Wrapper</h2>';

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
$container .= '<label for="title">Skrytý nadpis</label>';
$container .= '<p>Nadpis bloku, který se zobrazuje v BE (např. <u>Wrapper pro obrázek</u>)</p>';
$container .= '<input type="text" name="title"  id="title" value="'.$title.'">';
$container .= '</div>';

$container .= '<div class="form_input">';
$container .= '<label for="class">Jméno třídy</label>';
$container .= '<p>Class name (např. <u>Wrapper pro obrázek</u>)</p>';
$container .= '<input type="text" name="class"  id="class" value="'.$class.'">';
$container .= '</div>';

$container .= '<input type="submit" value="Uložit" name="wrapperForm">';

$container .= '</form>';
$container .= '</div>';

return $container;