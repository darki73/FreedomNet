<?php
require_once('header.php');
use Core\Libraries\FreedomCore\System\Manager as Manager;
use Core\Libraries\FreedomCore\System\Database as Database;

Manager::LoadExtension('DatabaseManager');
use Core\Extensions\DatabaseManager as DBManager;
//$DBManager = new DBManager();
//$Installer->assignDBManager($DBManager);
//$Installer->setWebsiteDatabase();
//$Installer->buildInitialTables();


die();
$Smarty->assign('Github', $Installer->getGithubRepoStatus());
$Smarty->assign('InstallerVersion', $Installer->getInstallerVersion());

$Smarty->assign('StepID', 'Step #3');
$Smarty->display('installation/database');