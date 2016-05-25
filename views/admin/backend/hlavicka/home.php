<?php
$container = '<h1>Nastavení hlavičky webu</h1>';
$container .= '<p>Celá hlavička má ve FE <u>id="<i>header</i>"</u>.</p>';

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
$container .= '<label for="title">Hlavní titulek</label>';
$container .= '<p>Tento titulek je hlavní titulek hlavičky (DOM: id="<i>header_mainTitle</i>")</p>';
$container .= '<input type="text" name="title"  id="title" value="' . $title . '">';
$container .= '</div>';

$container .= '<div class="form_input">';
$container .= '<label for="subtitle">Podtitulek</label>';
$container .= '<p>Tento nápis se objevuje také v hlavičce, ale je jen jako doplnění hlavního titulku (DOM: id="<i>header_subTitle</i>")</p>';
$container .= '<input type="text" name="subtitle"  id="subtitle" value="' . $subtitle . '">';
$container .= '</div>';

$container .= '<div class="form_input">';
$container .= '<label for="description">Text v hlavičce</label>';
$container .= '<p>Tento text se objevuje v hlavičce - je možnost použít zde i html tagy (DOM: id="<i>header_text</i>")</p>';
$container .= '<textarea id="description" name="description">' . $description . '</textarea>';
$container .= '</div>';

$container .= '<input type="submit" value="Uložit" name="hlavickaForm">';

$container .= '</form>';
$container .= '</div>';

return $container;