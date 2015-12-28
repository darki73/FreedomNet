<?php
require_once('header.php');

$Smarty->assign('Github', $Installer->getGithubRepoStatus());
$Smarty->display('installation/welcome');