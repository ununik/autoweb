<?php
if (isset($_GET['part'])) {
	switch ($_GET['part']) {
		case 'css':
			include HOME_PATH . '/controllers/admin/web/css.php';
			break;
	}
}