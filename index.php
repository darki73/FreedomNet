<?php
require_once('Core/Core.php');

use Core\Libraries\FreedomCore\System\Manager as Manager;
use Core\Libraries\FreedomCore\System\Page as Page;
use Core\Extensions\Website as Website;

$Website = Manager::LoadExtension('Website', $Smarty, true);


$Smarty->translate('Account');
$Smarty->assign('InstalledPatches', $Website->getInstalledPatches());
$Smarty->assign('Page', Page::Info('homepage', array('bodycss' => 'homepage', 'pagetitle' => '')));
$Smarty->display('landing');