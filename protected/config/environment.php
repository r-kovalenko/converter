<?php

/**
 * This class helps you to config your Yii application
 * environment.
 * Any comments please post a message in the forum
 * Enjoy it!
 *
 * @name Environment
 * @author Fernando Torres | Marciano Studio
 * @version 1.0
 */
class Environment
{

	const DEV = 100;
	const TEST = 200;
	const STAGE = 300;
	const PROD = 400;

	private $_mode = 0;
	private $_debug;
	private $_trace_level;
	private $_config;
	private $_yiiPath;

	const MAIN_CONFIG = 'main.php';
	const SERVER_VAR = 'PROJECT_SERVER_NAME';

	/**
	 * Initilizes the Environment class with the given mode
	 * @param constant $mode
	 */
	function __construct($mode = null)
	{
		$this->_mode = $this->getMode($mode);
		$this->setEnv();
	}

	/**
	 * Get current environment mode depending on environment variable
	 * @param <type> $mode
	 * @return <type>
	 * @throws Exception
	 */
	private function getMode($mode = null)
	{
		// If not overriden
		if (!isset($mode)) {
			// Return mode based on Apache server var
			if (isset($_SERVER[self::SERVER_VAR])) {
				$mode = $_SERVER[self::SERVER_VAR];
			} else {
				throw new Exception('SetEnv ' . self::SERVER_VAR . '<mode> not defined in web server config.');
			}
		}

		// Check if mode is valid
		if (!defined('self::' . $mode)) {
			throw new Exception('Invalid Environment mode');
		}

		return $mode;
	}

	/**
	 * Returns the path to the Yii framework
	 * @return string
	 */
	public function getYiiPath()
	{
		return $this->_yiiPath;
	}

	/**
	 * Returns the debug mode
	 * @return Bool
	 */
	public function getDebug()
	{
		return $this->_debug;
	}

	/**
	 * Returns the trace level for YII_TRACE_LEVEL
	 * @return int
	 */
	public function getTraceLevel()
	{
		return $this->_trace_level;
	}

	/**
	 * Returns the configuration array depending on the mode
	 * you choose
	 * @return array
	 */
	public function getConfig()
	{
		return $this->_config;
	}


	/**
	 * Sets the configuration for the choosen environment
	 */
	private function setEnv()
	{

		$config_main = $this->_main();
		// Load specific config
		$configFile = dirname(__FILE__) . DIRECTORY_SEPARATOR . strtolower($this->_mode) . '.php';

		if (!file_exists($configFile)) {
			throw new Exception('Cannot find config file "' . $configFile . '".');
		}
		require($configFile);

		if (!isset($config)) {
			throw new Exception('Undeclared variable $config in file "' . $configFile . '".');
		}
		if (!isset($yiiPath)) {
			throw new Exception('Undeclared variable $yiiPath in file "' . $configFile . '".');
		}
		if (!isset($debug)) {
			throw new Exception('Undeclared variable $debug in file "' . $configFile . '".');
		}
		if (!isset($trace_level)) {
			throw new Exception('Undeclared variable $trace_level in file "' . $configFile . '".');
		}
		// Merge config arrays into one
		$this->_config = array_merge_recursive($config_main, $config);

		// Set other environment vars
		$this->_yiiPath = $yiiPath;
		$this->_debug = $debug;
		$this->_trace_level = $trace_level;
//		$this->_config['params']['environment'] = constant('self::' . $this->_mode);
	}


	/**
	 * Main configuration
	 * This is the general configuration that uses all environments
	 */
	private function _main()
	{
		$configMainFile = dirname(__FILE__) . DIRECTORY_SEPARATOR . self::MAIN_CONFIG;
		if (!file_exists($configMainFile)) {
			throw new Exception('Cannot find config file "' . $configMainFile . '".');
		}
		return require($configMainFile);
	}

}// END Environment Class