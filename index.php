<?php
require_once('Core/Core.php');

use Core\Libraries\FreedomCore\System\Page as Page;

$Smarty->translate('Account');
$Smarty->assign('Page', Page::Info('homepage', array('bodycss' => 'homepage', 'pagetitle' => '')));
$Smarty->display('landing');