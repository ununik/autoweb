<?php
if (defined('DB_NAME') && defined('DB_HOST') && defined('DB_LOGIN') && defined('DB_PASSWORD')) {
	$result = Connection::connect()->prepare(
			file_get_contents(HOME_PATH . '/models/library/importTables.sql')
		);
	$result->execute();
	return;
}

$result = $dbh->prepare(
			file_get_contents(HOME_PATH . '/models/library/importTables.sql')
		);
$result->execute();