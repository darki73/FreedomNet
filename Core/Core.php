<?php
require_once('Core/Classes/Bootstrap.Class.php');
use Core\Classes\Bootstrap as Bootstrap;
use Core\Classes\ErrorHandler as ErrorHandler;
use Core\Libraries\FreedomCore\System\Manager as Manager;
use Core\Libraries\FreedomCore\System\Session as Session;
use Core\Extensions\User as User;
use Core\Extensions\Account as Account;

if(isset($_ENV['installation_in_progress']))
    Bootstrap::Initialize(false);
else {
    Bootstrap::Initialize();
    $Session = new Session();
    Manager::LoadExtension('DatabaseManager');
    $User = Manager::LoadExtension('User', $Smarty, true);
    $Account = Manager::LoadExtension('Account', $Smarty, true);
    $Website = Manager::LoadExtension('Website', $Smarty, true);
}
new ErrorHandler($Smarty);
