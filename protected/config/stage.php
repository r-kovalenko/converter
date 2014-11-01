<?php
return array(

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
					'levels' => 'error, warning, trace, info',
				),

			),
		),
	),
);