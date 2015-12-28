<?php
require_once('Core/Libraries/Smarty/Smarty.class.php');

use Core\Libraries\FreedomCore\System as System;
use Core\Libraries\FreedomCore\System\Debugger as Debugger;

global $FreedomCore, $Directory, $FCCore, $Smarty;
$Directory = str_replace("\\", "/", getcwd());
Class Smarty_FreedomCore extends Smarty
{
    function __construct($Template)
    {
        global $FreedomCore, $Directory, $FCCore;
        parent::__construct();

        if(isset($_ENV['installation_in_progress'])){
            $FCCore = [
                'Template'					=>	'FreedomCore',
                'ApplicationName'			=>	'FreedomCore',
                'ApplicationDescription'	=>	'FreedomCore CMS',
                'ApplicationKeywords'		=>	'FreedomCore, Darki73, FreedomCMS, FreedomCore CMS',
                'ExpansionTemplate'			=>	'WoD',
                'SmartyDebug'				=>	false,
                'SmartyCaching'				=>	false,
                'debug'						=>	false,
            ];
        }

        $TemplatesDir = $Directory.'/Templates/'.$FCCore['Template'].'/';
        $CompileDir = $Directory.'/Cache/Compile/Templates/'.$FCCore['Template'].'/';
        $this->setTemplateDir($TemplatesDir);
        $this->setCompileDir($CompileDir);
        $this->setConfigDir($FreedomCore->getLanguageDir());
        $this->setCacheDir($FreedomCore->getCacheDir());
        $this->configLoad($FreedomCore->loadLanguage());
        // Debug Mode
        $this->debugging = $FCCore['SmartyDebug'];
        $this->assign('https', isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on');

        // Template Vars
        $this->left_delimiter = '{';
        $this->right_delimiter = '}';
        // Caching
        if($FCCore['SmartyCaching'])
        {
            $this->caching = true;
            $this->setCaching(Smarty::CACHING_LIFETIME_CURRENT);
        }
        else
            $this->caching = false;
        // System Vars
        $this->assign('Language', System\Utilities::LanguageCode());
        if(!isset($_SERVER['HTTP_HOST']))
            $this->assign('HTTPHost', '//'.$_SERVER['SERVER_NAME']);
        else
            $this->assign('HTTPHost', '//'.$_SERVER['HTTP_HOST']);
        $this->assign('AppName', $FCCore['ApplicationName']);
        $this->assign('AppDescription', $FCCore['ApplicationDescription']);
        $this->assign('AppKeywords', $FCCore['ApplicationKeywords']);
        $this->assign('Template', $FCCore['Template']);

        if(!isset($_ENV['installation_in_progress'])) {
            // Social Links
            $this->assign('SLFacebook', $FCCore['Social']['Facebook']);
            $this->assign('SLTwitter', $FCCore['Social']['Twitter']);
            $this->assign('SLTwitter', $FCCore['Social']['Vkontakte']);
            $this->assign('SLSkype', $FCCore['Social']['Skype']);
            $this->assign('SLYoutube', $FCCore['Social']['Youtube']);
            $this->assign('FacebookAdmins', $FCCore['Facebook']['admins']);
            $this->assign('FacebookPage', $FCCore['Facebook']['pageid']);

            // Google Analytics
            $this->assign('GoogleAnalytics', array('Account' => $FCCore['GoogleAnalytics']['Account'], 'Domain' => $FCCore['GoogleAnalytics']['Domain']));
        }
    }
    function display($template = NULL, $cache_id = NULL, $compile_id = NULL, $parent = NULL)
    {
        global $FCCore;
        if($FCCore['debug'])
        {
            $this->assign('PageLoadTime', System\Utilities::PageLoadTime());
            $this->assign('MemoryUsage', System\Utilities::GetMemoryUsage());
            $this->assign('Debug', true);
        }
        else
            $this->assign('Debug', false);
        try {
            Smarty::Display($template.".tpl");
        } catch (Exception $e) {
            Debugger::ReportError(3, 1, $template.".tpl");
        }
    }

    function translate($TranslationFile)
    {
        global $FreedomCore;
        $Language = str_replace('.language', '', $FreedomCore->loadLanguage());
        try {
            Smarty::configLoad($Language.DS.$TranslationFile.'.language');
        } catch (Exception $e) {
            Debugger::ReportError(3, 2, $TranslationFile.'.language in '.$Language.' language folder');
            die();
        }
    }

    function variable($Variable)
    {
        return $this->getConfigVariable($Variable);
    }
}
$Smarty = new Smarty_FreedomCore($FCCore['Template']);
?>