<?php
$yiiPath = dirname(__FILE__) . '/../../../../../home/rkovalenko/yii/framework/yii.php';
$debug = false;
$trace_level = 0;
$config = array(

	// Application components
	'components' => array(

		// Database
		'db' => array(
			'connectionString' => 'Your connection string to your production server',
			'emulatePrepare' => false,
			'username' => 'admin',
			'password' => 'password',
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
					'emails' => 'admin@example.com',
				),
			),
		),
	),
);