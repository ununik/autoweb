<?php
class Connection extends PDO
{
	private static $_instance = null;

	public function __construct()
	{
		self::$_instance = $this->realConnect();
	}

	public static function connect()
	{
		if (!self::$_instance instanceof Connection && self::$_instance == null) {
			new Connection();
		}

		return self::$_instance;
	}

	protected function realConnect()
	{
		$dbh = new PDO('mysql:host=' . DB_HOST . ';dbname=' .DB_NAME, DB_LOGIN, DB_PASSWORD);
		return $dbh;
	}
}