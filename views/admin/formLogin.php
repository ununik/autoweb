<?php
$container = '<h1>Přihlášení do administrace</h1>';

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
$container .= '<p>Přihlašovcí jméno administrátora (např. <u>admin</u>)</p>';
$container .= '<input type="text" name="login"  id="login" value="' . $login . '" tabindex="1">';
$container .= '</div>';

$container .= '<div  class="form_input">';
$container .= '<label for="password">Heslo</label>';
$container .= '<p>Přihlašovací heslo administrátora (např. <u>heslo1234</u>)</p>';
$container .= '<input type="password" name="password"  id="password" tabindex="2">';
$container .= '</div>';

$container .= '<input type="submit" value="Přihlásit se" name="loginForm" tabindex="3">';

$container .= '</form>';
$container .= '</div>';

return $container;