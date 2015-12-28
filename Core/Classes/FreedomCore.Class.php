<?php
namespace Core\Classes;
require_once('Core/Libraries/FreedomCore/FreedomCore.Library.php');
use Core\Libraries\FreedomCore\FreedomCore as FreedomCore;

global $Directory, $FreedomCore;
$Directory = getcwd();

class FreedomCore_Base extends FreedomCore{

    function __construct(){
        global $FCCore, $Directory;
        parent::__construct();
        $CachePath = $Directory.DIRECTORY_SEPARATOR.'Cache'.DIRECTORY_SEPARATOR;
        $CorePath = $Directory.DIRECTORY_SEPARATOR.'Core'.DIRECTORY_SEPARATOR;
        $ExtPath = $Directory.DIRECTORY_SEPARATOR.'Extensions'.DIRECTORY_SEPARATOR;

        $this->cache_dir        = $CachePath.'FreedomCore'.DIRECTORY_SEPARATOR;
        $this->languages_dir    = $CorePath.'Languages'.DIRECTORY_SEPARATOR;
        $this->config_dir       = $CorePath.'Configuration'.DIRECTORY_SEPARATOR;
        $this->extensions_dir   = $ExtPath;
        $this->load_config      = 'Default';
        $this->set_timezone     = $FCCore['TimeZone'];
    }
}

$FreedomCore = new FreedomCore_Base();