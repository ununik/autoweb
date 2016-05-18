<?php
$container = '<h1>Nastavení webu</h1>';

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
$container .= '<label for="name">Název webu</label>';
$container .= '<p>Hlavní název webu, který se bude objevovat například v titulku (např. <u>Můj web</u>)</p>';
$container .= '<input type="text" name="name"  id="name" value="' . $name . '">';
$container .= '</div>';

$container .= '<div class="form_input">';
$container .= '<label for="author">Autor</label>';
$container .= '<p>Jméno autora, které se objevuje v meta dataech stránky (např. <u>Jan Novák</u>)</p>';
$container .= '<input type="text" name="author"  id="author" value="' . $author . '">';
$container .= '</div>';

$container .= '<div class="form_input">';
$container .= '<label for="mail">Autorův email</label>';
$container .= '<p>Email, který bude bude uveden jako nejhlavnější kontakt (např. <u>mujmail@mail.cz</u>)</p>';
$container .= '<input type="text" name="mail"  id="mail" value="' . $mail . '">';
$container .= '</div>';

$container .= '<div class="form_input">';
$container .= '<label for="description">Meta popis</label>';
$container .= '<p>Popis webu pro robotické vyhledávače. Tento popis se zobrazuje u vyhledaných výsledků (např. <u>Web věnovaný mému koníčku, který ...</u>)</p>';
$container .= '<textarea id="description" name="description">' . $description . '</textarea>';
$container .= '</div>';

$container .= '<input type="submit" value="Předchozí krok" name="adminBack">';
$container .= '<input type="submit" value="Uložit a spustit administraci" name="page">';

$container .= '</form>';
$container .= '</div>';

return $container;