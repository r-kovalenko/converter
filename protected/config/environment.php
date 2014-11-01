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

	const DEVELOPMENT = 100;
	const TEST = 200;
	const STAGE = 300;
	const PRODUCTION = 400;

	private $_mode = 0;
	private $_debug;
	private $_trace_level;
	private $_config;


	/**
	 * Initilizes the Environment class with the given mode
	 * @param constant $mode
	 */
	function __construct($mode)
	{
		$this->_mode = $mode;
		$this->setConfig();
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
	private function setConfig()
	{
		switch ($this->_mode) {
			case self::DEVELOPMENT:
				$this->_config = array_merge_recursive($this->_main(), $this->_development());
				$this->_debug = TRUE;
				$this->_trace_level = 3;
				break;
			case self::TEST:
				$this->_config = array_merge_recursive($this->_main(), $this->_test());
				$this->_debug = FALSE;
				$this->_trace_level = 0;
				break;
			case self::STAGE:
				$this->_config = array_merge_recursive($this->_main(), $this->_stage());
				$this->_debug = TRUE;
				$this->_trace_level = 0;
				break;
			case self::PRODUCTION:
				$this->_config = array_merge_recursive($this->_main(), $this->_production());
				$this->_debug = FALSE;
				$this->_trace_level = 0;
				break;
			default:
				$this->_config = $this->_main();
				$this->_debug = TRUE;
				$this->_trace_level = 0;
				break;
		}
	}


	/**
	 * Main configuration
	 * This is the general configuration that uses all environments
	 */
	private function _main()
	{
		return require(dirname(__FILE__) . '/main.php');
	}


	/**
	 * Development configuration
	 * Usage:
	 * - Local website
	 * - Local DB
	 * - Show all details on each error.
	 * - Gii module enabled
	 */
	private function _development()
	{
		return require(dirname(__FILE__) . '/dev.php');
	}


	/**
	 * Test configuration
	 * Usage:
	 * - Local website
	 * - Local DB
	 * - Standard production error pages (404,500, etc.)
	 */
	private function _test()
	{
		return require(dirname(__FILE__) . '/test.php');
	}

	/**
	 * Stage configuration
	 * Usage:
	 * - Online website
	 * - Production DB
	 * - All details on error
	 */
	private function _stage()
	{
		return require(dirname(__FILE__) . '/stage.php');
	}

	/**
	 * Production configuration
	 * Usage:
	 * - online website
	 * - Production DB
	 * - Standard production error pages (404,500, etc.)
	 */
	private function _production()
	{
		return require(dirname(__FILE__) . '/prod.php');
	}
}// END Environment Class