<?php
namespace Core\Classes;
use Core\Libraries\FreedomCore\System as System;

class Bootstrap{
    private static $isDebugEnabled = false;
    public static $PageLoadTime;

    /**
     * Initialize Bootstrap Configuration
     * @param bool|true $WithConfig     - Specifies Should Bootstrap Class Initialize Itself With Configuration File Or Without It
     */
    public static function Initialize($WithConfig = true){
        if($WithConfig)
            Bootstrap::LoadConfig();
        Bootstrap::LoadComponents();
        if(Bootstrap::$isDebugEnabled)
            Bootstrap::$PageLoadTime = System\Utilities::PageLoadTime(true);
    }

    /**
     * This Method Is Used To Load Configuration File
     */
    private static function LoadConfig(){
        $FilePath = 'Core'.DIRECTORY_SEPARATOR.'Configuration'.DIRECTORY_SEPARATOR.'Configuration.php';
        $FullPath = getcwd().DIRECTORY_SEPARATOR.$FilePath;
        if(file_exists($FullPath)){
            require_once($FilePath);
            if($FCCore['debug'])
                Bootstrap::$isDebugEnabled = true;
        } else {
            header('Location: /Install');
        }

    }

    /**
     * This Method Is Used To Initiate Loading Order Of Specified Components
     */
    private static function LoadComponents(){
        $Components = ['Classes'];
        foreach($Components as $Component)
            Bootstrap::LoadOrder($Component);
    }

    /**
     * This Method Is Used To Load Additional Files Specified In A JSON File Inside Given Directory
     * @param $Dirname              - Directory To Browse For Additional Files
     */
    private static function LoadOrder($Dirname){
        $DirectoryPath = realpath(dirname(__FILE__));
        $LoadOrderFile = $DirectoryPath.DIRECTORY_SEPARATOR."LoadOrder.json";
        $LoadOrder = json_decode(file_get_contents($LoadOrderFile), true);
        foreach($LoadOrder['LoadOrder'] as $LoadItem)
            if(!empty($LoadItem))
                require_once($DirectoryPath.DIRECTORY_SEPARATOR.$LoadItem);
    }
}