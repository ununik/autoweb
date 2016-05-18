<?php
$container = '<h1>Nastavení administrátora</h1>';

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
$container .= '<label for="login">Login</label>';
$container .= '<p>Přihlašovcí jméno hlavního administrátora (např. <u>admin</u>)</p>';
$container .= '<input type="text" name="login"  id="login" value="' . $login . '" tabindex="1">';
$container .= '</div>';

$container .= '<div  class="form_input">';
$container .= '<label for="password">Heslo</label>';
$container .= '<p>Přihlašovací heslo pro hlavního administrátora (např. <u>heslo1234</u>)</p>';
$container .= '<input type="password" name="password"  id="password" tabindex="2">';
$container .= '</div>';

$container .= '<div  class="form_input">';
$container .= '<label for="password2">Ověření hesla</label>';
$container .= '<p>Znovu přihlašovací heslo z důvodu ověření správnosti hesla (např. <u>heslo1234</u>)</p>';
$container .= '<input type="password" name="password2"  id="password2" tabindex="3">';
$container .= '</div>';

$container .= '<input type="submit" value="Předchozí krok" name="mysqlBack" tabindex="5">';
$container .= '<input type="submit" value="Uložit a pokračovat" name="admin" tabindex="4">';

$container .= '</form>';
$container .= '</div>';

return $container;