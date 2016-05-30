<?php
$time = time();
$connection = "<?php
define('DB_NAME', '$name');
define('DB_HOST', '$host');
define('DB_LOGIN', '$login');
define('DB_PASSWORD', '$password');
define('PASSWORD_SALT', '$time');
";


if (!is_dir(TEMP_FOLDER)) {
	mkdir(TEMP_FOLDER);
}
$dbFile = fOpen(MYSQL_CONNECTION_CONFIG_PATH, 'w');
fwrite($dbFile, $connection);
fclose($dbFile);

touch(INSTALL_LOCK_MYSQL);