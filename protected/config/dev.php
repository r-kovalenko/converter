<?php
$yiiPath = dirname(__FILE__) . '/../../framework/yii.php';
$debug = TRUE;
$trace_level = 3;
$config = array(

	'modules' => array(
		// uncomment the following to enable the Gii tool
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => '123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters' => array('127.0.0.1', '::1'),
		),
	),

	// application components
	'components' => array(
		'db' => array(
			'connectionString' => 'mysql:host=localhost;dbname=converter',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => require 'db_password_local.php',
			'charset' => 'utf8',
		),
		'routes' => array(
			// Save log messages on file
			array(
				'class' => 'CFileLogRoute',
				'levels' => 'error, warning,trace, info',
			),
			// Show log messages on web pages
			array(
				'class' => 'CWebLogRoute',
				'levels' => 'error, warning, trace, info',
			),
		),
	),
);