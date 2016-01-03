<?php
require_once('header.php');
use Core\Libraries\FreedomCore\System\Manager as Manager;
use Core\Libraries\FreedomCore\System\Database as Database;

//$Installer->buildInitialTables();
echo "<pre>";

print_r($Installer->populateInstalledPatchesTable());


die();
$Smarty->assign('Github', $Installer->getGithubRepoStatus());
$Smarty->assign('InstallerVersion', $Installer->getInstallerVersion());

$Smarty->assign('StepID', 'Step #3');
$Smarty->display('installation/database');