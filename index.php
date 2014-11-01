<?php

require_once(dirname(__FILE__) . '/protected/config/environment.php');
$environment = new Environment();

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', $environment->getDebug());
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', $environment->getTraceLevel());

require_once($environment->getYiiPath());
Yii::createWebApplication($environment->getConfig())->run();
