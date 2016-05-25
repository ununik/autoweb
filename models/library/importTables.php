<?php
if (defined('DB_NAME') && defined('DB_HOST') && defined('DB_LOGIN') && defined('DB_PASSWORD')) {
	$sql = file_get_contents(HOME_PATH . '/models/library/importTables.sql');
	
	//ALTER TABLE  `webSettings_autoweb` ADD  `header_mainTitle` VARCHAR( 255 ) NOT NULL ;
	
	$result = Connection::connect()->prepare(
			$sql
		);
	$result->execute();
	return;
}

$result = $dbh->prepare(
			file_get_contents(HOME_PATH . '/models/library/importTables.sql')
		);
$result->execute();