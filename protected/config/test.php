<?php
$yiiPath = dirname(__FILE__) . '/../../framework/yii.php';
$debug = false;
$trace_level = 0;
$config = array(
	'components' => array(
		'fixture' => array(
			'class' => 'system.test.CDbFixtureManager',
		),
		'connectionString' => 'Your connection string to your local testing server',
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
				'levels' => 'error, warning,trace, info',
			),

			// Show log messages on web pages
			array(
				'class' => 'CWebLogRoute',
				'levels' => 'error, warning',
			),
		),
	)
);