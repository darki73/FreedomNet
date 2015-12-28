<?php
require_once('Core/Classes/Bootstrap.Class.php');
use Core\Classes\Bootstrap as Bootstrap;
use Core\Classes\ErrorHandler as ErrorHandler;


if(isset($_ENV['installation_in_progress']))
    Bootstrap::Initialize(false);
else
    Bootstrap::Initialize();
new ErrorHandler($Smarty);