<?php
namespace Core\Extensions;

use Core\Libraries\FreedomCore\System\Database as Database;

class Website {

    /**
     * Website Database Connection PDO Object Reference
     * @var
     */
    protected $Connection;

    /**
     * Smarty Reference For Local Use
     * @var
     */
    protected $TM;

    /**
     * Website constructor.
     */
    public function __construct($TemplatesManager){
        $this->Connection = Database::$Connections['Website'];
        $this->TM = $TemplatesManager;
    }

    /**
     * Get Installed Patches To Be Displayed On Main Page
     * @return array|bool|mixed
     */
    public function getInstalledPatches(){
        return Database::plainSQLPDO($this->Connection, 'SELECT * FROM installed_patches', true, true);
    }

    public function selectGameDatabase(){

    }

    /**
     * Get Theme for Authorization and Registration Page
     * @param $Request
     * @return string
     */
    public function getWebsiteTheme($Request){
        $AllowedThemes = ['classic', 'tbc', 'wotlk', 'cata', 'mop', 'wod', 'legion', 'bnet'];
        if(isset($Request['theme']))
            if(in_array($Request['theme'], $AllowedThemes))
                return 'wow-'.$Request['theme'];
        return 'bnet';
    }

}