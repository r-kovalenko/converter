<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'Numbers converter',

	// preloading 'log' component
	'preload' => array('log'),

	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.components.*',
	),

	// application components
	'components' => array(
		'user' => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		'urlManager' => array(
			'class' => 'application.components.UrlManager',
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => array(
				'sitemap.xml' => 'sitemap/index',
				'sitemap_google.xml' => 'sitemapg/index',
				'<language:(en|ru|uk)>/' => 'site/index',
				'<language:(en|ru|uk)>/<action:(contact|login|logout)>/*' => 'site/<action>',
				'<language:(en|ru|uk)>/<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<language:(en|ru|uk)>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<language:(en|ru|uk)>/<controller:\w+>/<action:\w+>/*' => '<controller>/<action>',

			),
		),
		'errorHandler' => array(
			// use 'site/error' action to display errors
			'errorAction' => 'site/error',
		),
		'request' => array(
			'enableCookieValidation' => true,
			'enableCsrfValidation' => true,
		),
		'cache' => array(
			'class' => 'system.caching.CFileCache',
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => array(
		// this is used in contact page
		'adminEmail' => 'admin@numbertowords.com',
		'languages' => array('en' => 'English', 'ru' => 'Русский', 'uk' => 'Українська'),
		'ga_id' => 'UA-56605927-1',
		'gtm_id' => 'GTM-MKKPTS',
		'environment' => $this->_mode,
	),
);