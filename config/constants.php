<?php
define ('TEMP_FOLDER', HOME_PATH . '/temp/');
define ('INSTALL_LOCK', HOME_PATH . '/temp/installed');
define ('CSS_FRONTEND', HOME_PATH . '/css/all.css');
define ('INSTALL_LOCK_MYSQL', HOME_PATH . '/temp/mysql');
define ('INSTALL_LOCK_ADMIN', HOME_PATH . '/temp/admin');
define ('MYSQL_CONNECTION_CONFIG_PATH', HOME_PATH . '/config/databaseConnection.php');

define ('TEXT_EDITOR_SCRIPT',
	"tinymce.init({
	  selector: 'textarea',
	  height: 500,
	  plugins: [
	    'advlist autolink lists link image charmap print preview anchor',
	    'searchreplace visualblocks code fullscreen',
	    'insertdatetime media table contextmenu paste code'
	  ],
	  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
	
	});"
);