<?php
use \Library\fce;

$html->addCssFile('css/admin.css');

$login = '';
$err = array();

if (isset($_POST['loginForm'])) {
	$login = \Library\fce\safeText($_POST['login']);
	$password = \Library\fce\safeText($_POST['password']);
	
	if (strlen($login) == 0) {
		$err[] = 'Není vyplněný login.';
	} else if (strlen($login) > 255) {
		$err[] = 'Vyplněný login je příliš dlouhý.';
	}
		
	if (strlen($password) == 0) {
		$err[] = 'Není vyplněné heslo.';
	}
	
	if (count($err) == 0) {	
		$result = Connection::connect()->prepare(
				'SELECT `id` FROM `be_users_autoweb` WHERE login=:login AND password=:password AND active=1 AND DELETED=0 ORDER BY `id` DESC;'
		);
		$result->execute(array(
				':login' => $login,
				':password' => \Library\fce\passwordHash($password)
		));
		
		$users = $result->fetch();
		
		if (isset($users['id']) && $users['id'] > 0) {
			$_SESSION['autoweb'] = $users['id'];
			header('Location: http://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		} else {
			$err[] = 'Špatné jméno nebo heslo.';
		}
	}
}

$html->addToContent(include HOME_PATH . '/views/admin/formLogin.php');