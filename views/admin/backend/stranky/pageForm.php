<?php
$container = '<h1>Nová stránka</h1>';
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
$container .= '<label for="headline">Nadpis stránky</label>';
$container .= '<p>Nadpis celé stránky, současně se jedná o titulek v BE(např. <u>Můj nadpis</u>)</p>';
$container .= '<input type="text" name="headline"  id="headline" value="' . $headline . '">';
$container .= '</div>';

$container .= '<div class="form_input">';
$container .= '<label for="title">Titluek stránky</label>';
$container .= '<p>Titulek stránky, který se zobrazuje v hlavičce stránek jako title (např. <u>Můj nadpis</u>)</p>';
$container .= '<input type="text" name="title"  id="title" value="' . $title . '">';
$container .= '</div>';

$container .= '<div class="form_input">';
$container .= '<label for="meta_description">Meta popis stránky</label>';
$container .= '<p>Tento text se objevuje v jednom bloku patičky - je možnost použít zde i html tagy (DOM: class="<i>mojeTrida</i>" - viz pole výše)</p>';
$container .= '<textarea id="text" name="meta_description">' . $metaDescription . '</textarea>';
$container .= '</div>';

$container .= '<input type="submit" value="Uložit" name="pageForm">';

$container .= '</form>';
$container .= '</div>';

return $container;