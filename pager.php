<?php
require_once('Core/Core.php');

use Core\Libraries\FreedomCore\System\Page as Page;
use Core\Libraries\FreedomCore\System\Text as Text;

$Account = new \Core\Extensions\Account($Smarty);
$Session = new \Core\Libraries\FreedomCore\System\Session();

switch($_REQUEST['category']){
    case 'account':
        $Smarty->translate('Account');
        if(!$Session->getSessionStatus()){
            $Session->startSimple();
        } else {
            if(!is_null($User->getUserID()))
                $Smarty->assign('AccountBalance', $Account->getBalance($User->getUsername()));

            $Theme = $Website->getWebsiteTheme($_REQUEST);
            $Smarty->assign('STheme', $Theme);

            switch($_REQUEST['subcategory']){

                case 'login':
                    $Smarty->assign('CSRFToken', $Session->generateCSRFToken());
                    $Smarty->assign('Page', Page::Info('login', array('bodycss' => 'login-template web wow', 'pagetitle' => $Smarty->GetConfigVars('Account_Login').' - ')));
					$Smarty->display('account/login');
                break;

                case 'captcha.jpg':
                    header("Content-Type:image/png");
                    Text::GenerateCaptcha();
                break;

            }
        }
    break;
}

//$User->setEssentials(1, 'darki73', 'apple.zhivolupov@gmail.com', 4, 'USD', 25000, 'darki73', 1, 1);
//$Essentials = $User->getEssentials();
//
//echo "<pre>";
//print_r($Essentials);
//echo "</pre>";