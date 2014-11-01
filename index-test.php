<?php
/**
 * This is the bootstrap file for test application.
 * This file should be removed when the application is deployed for production.
 */

// change the following paths if necessary
$yii = dirname(__FILE__) . '/../../../home/rkovalenko/yii/framework/yii.php';
require_once(dirname(__FILE__) . '/protected/config/environment.php');
$environment = new Environment(Environment::TEST);

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', $environment->getDebug());

require_once($yii);
Yii::createWebApplication($environment->getConfig())->run();
