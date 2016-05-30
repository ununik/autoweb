<?php
$container = '<h1>Výběr typu obsahu pro '.$pageValues['headline'].'</h1>';
$container .= '<h2>Kalendář</h2>';

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

//TODO typ kalendare - denni, tydenni, mesicni, rocni
$container .= '<div class="form_input">';
$container .= '<label>Typ kalendáře</label>';
$container .= '<p>Určení, jak se má kalendář zobrazit</p>';

//DEN
$container .= '<div><input type="radio" name="type" class="radioForm" value="day"';
if ($type == 'day') {
    $container .= ' checked="checked"';
}
$container .= '> Denní';
$container .= '</div>';

//TYDEN
$container .= '<div><input type="radio" name="type" class="radioForm" value="week"';
if ($type == 'week') {
    $container .= ' checked="checked"';
}
$container .= '> Týdenní';
$container .= '</div>';

//Mesic
$container .= '<div><input type="radio" name="type" class="radioForm" value="month"';
if ($type == 'month') {
    $container .= ' checked="checked"';
}
$container .= '> Měsíční';
$container .= '</div>';

//Rok
$container .= '<div><input type="radio" name="type" class="radioForm" value="year"';
if ($type == 'year') {
    $container .= ' checked="checked"';
}
$container .= '> Ročnís';
$container .= '</div>';


$container .= '</div>';
$container .= '<input type="submit" value="Uložit" name="calendarForm">';

$container .= '</form>';
$container .= '</div>';

return $container;