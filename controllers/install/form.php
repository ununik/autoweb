<?php
use \Library\fce;

$html->addCssFile('css/install.css');

if (isset($_POST['mysqlBack'])) {
	unlink(INSTALL_LOCK_MYSQL);
	header('Location: http://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
}
if (isset($_POST['adminBack'])) {
	unlink(INSTALL_LOCK_ADMIN);
	header('Location: http://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
}

if (!file_exists(INSTALL_LOCK_MYSQL)) {
	
	$host = '';
	$name = '';
	$login = '';
	$password = '';
	$err = array();
	
	if (defined('DB_NAME')) {$name = DB_NAME;}
	if (defined('DB_HOST')) {$host = DB_HOST;}
	if (defined('DB_LOGIN')) {$login = DB_LOGIN;}
	if (defined('DB_PASSWORD')) {$password = DB_PASSWORD;	}
	
	
	if (isset($_POST['mysql'])) {
		$host = \Library\fce\safeText($_POST['host']);
		$name = \Library\fce\safeText($_POST['name']);
		$login = \Library\fce\safeText($_POST['login']);
		$password = \Library\fce\safeText($_POST['password']);
		
		try {
			$dbh = new PDO('mysql:host=' . $host . ';dbname=' .$name, $login, $password);
			include HOME_PATH . '/models/library/generateNewDBConnection.php';
			include HOME_PATH . '/models/library/importTables.php';
			header('Location: http://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		}
		catch (Exception $e) {
			$err[] = 'Špatné přihlašovací údaje do MySQL.'; 
		}
	}
	
	$html->addToContent(include HOME_PATH . '/views/install/formMysql.php');
	return;
}

if (!file_exists(INSTALL_LOCK_ADMIN)) {
	$err = array();
	$login = '';
	$password = '';
	
	if (isset($_POST['admin'])) {
		$login = \Library\fce\safeText($_POST['login']);
		$password = \Library\fce\safeText($_POST['password']);
		$password2 = \Library\fce\safeText($_POST['password2']);
		
		if (strlen($login) == 0) {
			$err[] = 'Není vyplněný login.';
		} else if (strlen($login) > 255) {
			$err[] = 'Vyplněný login je příliš dlouhý.';
		}
		
		if (strlen($password) == 0) {
			$err[] = 'Není vyplněné heslo.';
		}
		
		if ($password !== $password2) {
			$err[] = 'Zadaná hesla se neschodují.';
		}
		
		if (count($err) == 0) {
			$result = Connection::connect()->prepare(
				'UPDATE `be_users_autoweb` SET `root_admin`=0 WHERE 1=1;
				 INSERT INTO `be_users_autoweb`(`login`, `password`, `root_admin`) VALUES (:login, :password, 1);'
			);
			$result->execute(array(
				':login' => $login,
				':password' => \Library\fce\passwordHash($password)
			));
			touch(INSTALL_LOCK_ADMIN);
			header('Location: http://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		}
	}
	
	$html->addToContent(include HOME_PATH . '/views/install/formAdmin.php');
	return;
}

$err = array();
$name = '';
$author = '';
$description = '';
$mail = '';

if (isset($_POST['page'])) {
	$name = \Library\fce\safeText($_POST['name']);
	$author = \Library\fce\safeText($_POST['author']);
	$description = \Library\fce\safeText($_POST['description']);
	$mail = \Library\fce\safeText($_POST['mail']);
	
	if (strlen($name) == 0) {
		$err[] = 'Není vyplněný název webu.';
	}
	
	if (strlen($name) > 255) {
		$err[] = 'Vyplněný název webu je příliš dlouhý.';
	}
	
	if (strlen($author) > 255) {
		$err[] = 'Vyplněné jméno autora je příliš dlouhé.';
	}
	
	if (strlen($mail) > 255) {
		$err[] = 'Vyplněný email autora je příliš dlouhý.';
	} else if (strlen($mail) > 0 && !\Library\fce\validateEMAIL($mail)) {
		$err[] = 'Vyplněný email nemá správný tvar.';
	}
	
	if (count($err) == 0) {
			$result = Connection::connect()->prepare(
				'INSERT INTO `webSettings_autoweb`(`author`, `title`, `mail`, `meta_description`) VALUES (:author, :name, :mail, :description);'
			);
			$result->execute(array(
				':author' => $author,
				':name' => $name,
				':mail' => $mail,
				':description' => $description
			));
			touch(INSTALL_LOCK);
			header('Location: http://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] . '?page=admin');		
	}
}

$html->addToContent(include HOME_PATH . '/views/install/formPage.php');
return;
