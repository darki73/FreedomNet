<?php

namespace Core\Libraries\FreedomCore\System;

class Security {
	private static $GeneratedFilesList = [];

	public function __construct(){
		$this->hideServerIdentity();
		$this->addHeaders();
	}

	/**
	 * Fakes some server variables
	 */
	private function hideServerIdentity(){
		header('X-Powered-By: FreedomCore Management Engine');
		header('Server: FreedomCore HTTP Server IIS 7.5 (Windows Server 2012)');
	}

	/**
	 * Adds some security related headers
	 */
	private function addHeaders(){
		header("X-XSS-Protection: '1; mode=block'");
		header("X-Frame-Options: SAMEORIGIN");
		header("X-Content-Type-Options: nosniff");
	}

}

$SystemExtensionSecurity = new Security();