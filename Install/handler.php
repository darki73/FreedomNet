<?php
require_once('header.php');

if(isset($_REQUEST['action']))
    switch($_REQUEST['action']){
        case 'add-database':
            echo $Installer->createDatabaseFile($_REQUEST);
        break;

        case 'get-databases':
            echo $Installer->getDatabases();
        break;

        case 'add-website':
            echo $Installer->createWebsiteFile($_REQUEST);
        break;
    }
else
    die('ACCESS DENIED!');