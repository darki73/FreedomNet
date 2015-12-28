<?php
require_once('Core/Core.php');
use \Core\Libraries\FreedomCore\System\Manager as Manager;
use \Core\Extensions\FreedomNetAPI as FreedomNetAPI;

//unset($_SESSION['api_data']);
if(!isset($_SESSION['api_data'])){
    $APIData = [
        'spr'   =>  1,
        'rpm'   =>  50,
        'rph'   => 10,
        'first_request_time' => time(),
        'last_request_time'  => time(),
        'next_minute_cd_reset' => time() + 60,
        'next_hour_cd_reset' => time() + 3600,
        'request_count' => 1
    ];
} else {
    $AData = $_SESSION['api_data'];
    if($AData['last_request_time'] && time() - $AData['last_request_time'] < $AData['spr'])
        die('RPS LIMIT REACHED!');
    else {
        if($AData['request_count'] == $AData['rpm'] && $AData['first_request_time'] < $AData['first_request_time'] + 60)
            die('RPM LIMIT REACHED!!!!');
        else
            if($AData['request_count'] == $AData['rph'] && $AData['first_request_time'] < $AData['first_request_time'] + 3600)
                die('RPH LIMIT REACHED!!!');
            else
                $APIData = [
                    'spr'   =>  1,
                    'rpm'   =>  50,
                    'rph'   => 10,
                    'first_request_time' => $AData['first_request_time'],
                    'last_request_time'  => time(),
                    'request_count' => $AData['request_count'] + 1
                ];
    }
}
$_SESSION['api_data'] = $APIData;

if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

try {
    $API = new FreedomNetAPI($_REQUEST, $_SERVER['HTTP_ORIGIN']);
    echo $API->processAPI();
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}