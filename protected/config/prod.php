<?php
$yiiPath = dirname(__FILE__) . '/../../framework/yii.php';
$debug = false;
$trace_level = 0;
$config = array(

	// Application components
	'components' => array(

		// Database
		'db' => array(
			'connectionString' => 'mysql:host=numberto.mysql.ukraine.com.ua;dbname=numberto_db',
			'emulatePrepare' => false,
			'username' => 'numberto_db',
			'password' => 'fHjQYZqv',
			'charset' => 'utf8',
		),


		// Application Log
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),

				// Send errors via email to the system admin
				array(
					'class' => 'CEmailLogRoute',
					'levels' => 'error, warning',
					'emails' => 'admin@numbertowords.com',
				),
			),
		),
	),
);