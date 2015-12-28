<?php
require_once('header.php');

$Smarty->assign('Github', $Installer->getGithubRepoStatus());
$Smarty->assign('InstallerVersion', $Installer->getInstallerVersion());
$Smarty->assign('ServerInfo', $Installer->getServerInfo());
$Smarty->assign('Modules', $Installer->checkPHPModules());

$Smarty->assign('StepID', 'Step #1');
$Smarty->display('installation/begin');
