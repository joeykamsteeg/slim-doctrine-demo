<?php

	use App\App;

	require dirname(__FILE__)."/vendor/autoload.php";

	$config = array ();
	switch( $_SERVER['REMOTE_ADDR'] ){
		case '::1':
			$config['DB_DRIVER'] = 'pdo_mysql';
			$config['DB_HOST'] = 'localhost';
			$config['DB_USER'] = 'root';
			$config['DB_PASS'] = 'root';
			$config['DB_NAME'] = 'slim_doctrine';
		break;

		default:
			$config['DB_DRIVER'] = getenv('DB_DRIVER');
			$config['DB_HOST'] = getenv('DB_HOST');
			$config['DB_USER'] = getenv('DB_USER');
			$config['DB_PASS'] = getenv('DB_PASS');
			$config['DB_NAME'] = getenv('DB_NAME');
		break;
	}

	$app = new App( array(
		'DB_DRIVER' => $config['DB_DRIVER'],
		'DB_HOST' => $config['DB_HOST'],
		'DB_USER' => $config['DB_USER'],
		'DB_PASS' => $config['DB_PASS'],
		'DB_NAME' => $config['DB_NAME']
	) );
	$app->run();
?>
