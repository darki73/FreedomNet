<?php
namespace Core\Libraries\FreedomCore\System;

use Core\Libraries\FreedomCore\FreedomCore as FreedomCore;

Class Manager extends FreedomCore{

	public function __construct(){
		$APIClass = getcwd().DIRECTORY_SEPARATOR.'Core'.DIRECTORY_SEPARATOR.'Extensions'.DIRECTORY_SEPARATOR.'FreedomNetAPI.FreedomNet.php';
		require_once($APIClass);
	}

	public static function LoadSystemExtension($ExtensionName){
		$ExtensionPath = FREEDOMCORE_SYSTEM_DIR.$ExtensionName.'.FreedomCore.php';
		if(file_exists($ExtensionPath))
			require_once($ExtensionPath);
		else
			die("<strong>Unable to Load Extension: </strong>".$ExtensionName."<br />Check if this Extension actually exists");
	}

	/**
	 * Load FreedomCore Extension
	 * @param String $extension_name is a name of extension to be loaded
	 * @return Returning status of operation
	 */
	public static function LoadExtension($ExtensionName, $AdditionalInfo = null, $Return = false)
	{
		if(file_exists(FREEDOMCORE_EXTENSIONS_DIR.$ExtensionName.'.FreedomCore.php'))
		{
			$isNamespaced = false;
			require_once(FREEDOMCORE_EXTENSIONS_DIR.$ExtensionName.'.FreedomCore.php');
			$NamespacedClass = str_replace('/', '\\', str_replace('.', '', FREEDOMCORE_EXTENSIONS_DIR.$ExtensionName));

			if(!class_exists($ExtensionName))
				if(!class_exists($NamespacedClass))
					die('<strong>Loaded extension: </strong>'.$ExtensionName.'<br /><strong>Error: </strong> Class Name does not match Extension name');
				else
					$isNamespaced = true;

			if($AdditionalInfo != null)
				if($isNamespaced)
					if($Return == false)
						new $NamespacedClass($AdditionalInfo);
					else
						return new $NamespacedClass($AdditionalInfo);
				else
					if($Return == fasle)
						new $ExtensionName($AdditionalInfo);
					else
						return new $ExtensionName($AdditionalInfo);
		}
		else
		{
			echo "<strong>Unable to Load Extension: </strong>".$ExtensionName."<br />Check if this Extension actually exists";
			die();
		}
	}
}