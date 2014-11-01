<?php

// change the following paths if necessary
$yii = dirname(__FILE__) . '/../../../home/rkovalenko/yii/framework/yii.php';
//$config = dirname(__FILE__) . '/protected/config/main.php';
require_once(dirname(__FILE__) . '/protected/config/environment.php');
$environment = new Environment(Environment::DEVELOPMENT);

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', $environment->getDebug());
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', $environment->getTraceLevel());

require_once($yii);
Yii::createWebApplication($environment->getConfig())->run();
