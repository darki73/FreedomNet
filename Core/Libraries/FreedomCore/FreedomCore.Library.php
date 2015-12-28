<?php
namespace Core\Libraries\FreedomCore;
require_once('System/Manager.FreedomCore.php');

use Core\Libraries\FreedomCore\System\Manager as Manager;
use Core\Libraries\FreedomCore\System as System;
use Symfony\Component\Config\Definition\Exception\Exception;

$FreedomNetManager = new Manager();

/**
 * define shorthand directory separator constant
 */
if (!defined('DS'))
	define('DS', DIRECTORY_SEPARATOR);

if (!defined('PHP_NL'))
	define('PHP_NL', '<br />');

/**
 * set FREEDOMCORE_DIR to absolute path to FreedomCore library files.
 * Sets FREEDOMCORE_DIR only if user application has not already defined it.
 */
if (!defined('FREEDOMCORE_DIR'))
	define('FREEDOMCORE_DIR', '.' . DS . 'Core' . DS);

/**
 * set FREEDOMCORE_EXTENSIONS_DIR to absolute path to FreedomCore external plugins.
 * Sets FREEDOMCORE_EXTENSIONS_DIR only if user application has not already defined it.
 */
if (!defined('FREEDOMCORE_EXTENSIONS_DIR'))
	define('FREEDOMCORE_EXTENSIONS_DIR', FREEDOMCORE_DIR . 'Extensions' . DS);

/**
 * set FREEDOMCORE_EXTENSIONS_DIR to absolute path to FreedomCore external plugins.
 * Sets FREEDOMCORE_EXTENSIONS_DIR only if user application has not already defined it.
 */
if (!defined('FREEDOMCORE_PLUGINS_DIR'))
	define('FREEDOMCORE_PLUGINS_DIR', FREEDOMCORE_DIR . 'Plugins' . DS);

/**
 * set FREEDOMCORE_SYSTEM_EXTENSIONS_DIR to absolute path to FreedomCore internal plugins.
 * Sets FREEDOMCORE_SYSTEM_EXTENSIONS_DIR only if user application has not already defined it.
 */
if (!defined('FREEDOMCORE_SYSTEM_DIR'))
	define('FREEDOMCORE_SYSTEM_DIR', FREEDOMCORE_DIR . 'Libraries' . DS .'FreedomCore' . DS . 'System' .DS);

/**
 * set FREEDOMCORE_INTERFACES_DIR to absolute path to FreedomCore Interfaces.
 * Sets FREEDOMCORE_INTERFACES_DIR only if user application has not already defined it.
 */
if (!defined('FREEDOMCORE_INTERFACES_DIR'))
	define('FREEDOMCORE_INTERFACES_DIR', FREEDOMCORE_DIR . 'Libraries' . DS .'FreedomCore' . DS . 'Interfaces' .DS);


Class FreedomCore {
	const FREEDOMCORE_VERSION = "FreedomCore-3.0.0";
	public $template_dir, $compile_dir, $config_dir, $cache_dir, $FreedomCore;

	/**
	 * FreedomCore constructor.
	 */
	public function __construct(){
		$this->InitializeSystem();
		$this->FreedomCore = $this;
		$this->setExtensionsDir(FREEDOMCORE_EXTENSIONS_DIR)
				->setCacheDir('.' . DS . 'Cache' . DS)
				->setConfigDir('.' . DS . FREEDOMCORE_DIR . 'Configuration' . DS)
				->setLanguageDir('.' . DS . FREEDOMCORE_DIR . 'Languages' . DS);
		$this->verifyCurlInstallation();
		$this->verifyPDOInstallation();
	}

	/**
	 * Method to perform CURL installation Check
	 */
	private function verifyCurlInstallation(){
		if(in_array('curl', get_loaded_extensions()))
			$CurlInstalled = true;
		else
			$CurlInstalled = false;
		// TODO: Generate Proper Error Page for missing PHP Extension (CURL)
		if(!$CurlInstalled)
			die('Curl Extension is not installed!');
	}

	/**
	 * Method to perform PDO installation Check
	 */
	private function verifyPDOInstallation(){
		if(extension_loaded('pdo'))
			$PDOInstalled = true;
		else
			$PDOInstalled = false;
		// TODO: Generate Proper Error Page for missing PHP Extension (PDO)
		if(!$PDOInstalled)
			die('PDO_MySQL is not installed!');
	}

	/**
	 * This Method Is Used To Load System Extensions
	 */
	private function InitializeSystem(){
		Manager::LoadSystemExtension("Security");
		Manager::LoadSystemExtension("Session");
		Manager::LoadSystemExtension("Debugger");
		Manager::LoadSystemExtension("Utilities");
		Manager::LoadSystemExtension("Text");
		Manager::LoadSystemExtension("Database");
		Manager::LoadSystemExtension("Page");
		Manager::LoadSystemExtension("File");
	}

	/**
	 * Calls the appropriate setter function.
	 * Issues an E_USER_NOTICE if no valid setter is found.
	 *
	 * @param string $name  property name
	 * @param mixed  $value parameter passed to setter
	 */
	public function __set($name, $value){
		$allowed = array(
				'config_dir' => 'setConfigDir',
				'extensions_dir' => 'setExtensionsDir',
				'cache_dir' => 'setCacheDir',
				'languages_dir' => 'setLanguageDir',
				'load_config' => 'loadConfig',
				'set_timezone' => 'setTimezone',
		);
		if (isset($allowed[$name]))
			$this->{$allowed[$name]}($value);
	}

	/**
	 * Adds directory of plugin files
	 * @param $extensions_dir
	 * @return $this
	 */
	public function setExtensionsDir($extensions_dir){
		$this->extensions_dir = rtrim($extensions_dir, '/\\') . DS;
		return $this;
	}

	/**
	 * Set config directory
	 *
	 * @param  string|array Directory with configuration sources of
	 * @return FreedomCore for current FreedomCore instance for chaining
	 */
	public function setConfigDir($config_dir){
		$this->config_dir = rtrim($config_dir, '/\\') . DS;
		return $this;
	}

	/**
	 * Get config directory
	 *
	 * @param mixed $index of directory to get, null to get all
	 * @return array|string configuration directory
	 */
	public function getConfigDir($index=null){
		if ($index !== null)
			return isset($this->config_dir[$index]) ? $this->config_dir[$index] : null;
		return $this->config_dir;
	}

	/**
	 * Get plugin directories
	 *
	 * @return array list of extensions directories
	 */
	public function getExtensionsDir(){
		return $this->extensions_dir;
	}

	/**
	 * Set cache directory
	 *
	 * @param  string $cache_dir directory to store cached data in
	 * @return FreedomCore instance for chaining
	 */
	public function setCacheDir($cache_dir){
		$this->cache_dir = rtrim($cache_dir, '/\\') . DS;
		return $this;
	}

	/**
	 * Get cache directory
	 *
	 * @return string path of cache directory
	 */
	public function getCacheDir(){
		return $this->cache_dir;
	}

	/**
	 * Set Languages directory
	 *
	 * @param  string $languages_dir directory to store languages data in
	 * @return FreedomCore instance
	 */
	public function setLanguageDir($languages_dir){
		$this->languages_dir = rtrim($languages_dir, '/\\') . DS;
		return $this;
	}

	/**
	 * Get Languages directory
	 *
	 * @return string path of languages directory
	 */
	public function getLanguageDir(){
		return $this->languages_dir;
	}

	/**
	 * Get FreedomCore Version
	 *
	 * @return string Returning FreedomCore Engine Version
	 */
	public function getVersion(){
		return FreedomCore::FREEDOMCORE_VERSION;
	}

	/**
	 * Get User Language
	 *
	 * @return string Returning Preferred User Language base on Browser Language
	 */
	public function loadLanguage(){
		$UserLanguage = System\Utilities::GetLanguage();
		return $UserLanguage;
	}

	/**
	 * Load Configuration FIle
	 * Including Configuration file or Returning Debugger Error
	 */
	public function loadConfig(){
		if(!isset($_ENV['installation_in_progress'])){
			$Configuration = FreedomCore::getConfigDir().'Configuration.php';
			if(file_exists($Configuration))
				require_once($Configuration);
			else
				System\Debugger::ReportError(1,2, 'Configuration File');
		}

	}

	/**
	 * Set TimeZone
	 * @param Timezone Name
	 */
	public function setTimezone($TimeZone){
		if($TimeZone == NULL)
			date_default_timezone_set('Europe/Moscow');
		else
			date_default_timezone_set($TimeZone);
	}

	/**
	 * Get TimeZone
	 * @return string Returning Current TimeZone Settings
	 */
	public function getTimezone(){
		return date_default_timezone_get();
	}
}