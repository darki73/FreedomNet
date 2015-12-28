<?php
require_once('header.php');

$Smarty->assign('Github', $Installer->getGithubRepoStatus());
$Smarty->assign('InstallerVersion', $Installer->getInstallerVersion());

$Smarty->assign('StepID', 'Step #2');
$Smarty->display('installation/configurator');