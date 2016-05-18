<?php
$container = '<h1>Instalace MySQL připojení</h1>';

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
$container .= '<label for="host">Host</label>';
$container .= '<p>Jméno hostujícího serveru (např. <u>localhost</u>)</p>';
$container .= '<input type="text" name="host"  id="host" value="' . $host . '">';
$container .= '</div>';

$container .= '<div  class="form_input">';
$container .= '<label for="name">Jméno</label>';
$container .= '<p>Jméno databáze, která bude používaná (např. <u>blog</u>)</p>';
$container .= '<input type="text" name="name"  id="name" value="' . $name . '">';
$container .= '</div>';

$container .= '<div  class="form_input">';
$container .= '<label for="login">Login</label>';
$container .= '<p>Přihlašovací jméno do MySQL (např. <u>root</u>)</p>';
$container .= '<input type="text" name="login"  id="login" value="' . $login . '">';
$container .= '</div>';

$container .= '<div  class="form_input">';
$container .= '<label for="password">Password</label>';
$container .= '<p>Přihlašovací heslo do MySQL (např. <u>123456</u>)</p>';
$container .= '<input type="password" name="password"  id="password" value="' . $password . '">';
$container .= '</div>';

$container .= '<input type="submit" value="Uložit a pokračovat" name="mysql">';

$container .= '</form>';
$container .= '</div>';

return $container;