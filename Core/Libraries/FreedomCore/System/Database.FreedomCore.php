<?php

namespace Core\Libraries\FreedomCore\System;

use \PDO as PDO;
use \PDOException as PDOException;
use Core\Libraries\FreedomCore\System\Session as Session;

class Database {
    /**
     * Connection Array
     * @var array
     */
    public static $Connections = [];
    /**
     * Connection Name Selected For Custom Queries
     * @var
     */
    private static $SelectedConnection;

    /**
     * Database constructor.
     * @param $FCCore
     */
    public function __construct($FCCore){
        if(empty($FCCore))
            return false;
        $Databases = $this->getDatabaseLinks($FCCore);
        foreach($Databases as $Key=>$Value){
            if(count($Value) == 6) {
                try {
                    Database::$Connections[$Key] = new PDO(
                        "mysql:host=" . $Databases[$Key]['host'] . ";
                        dbname=" . $Databases[$Key]['database'] . ";
                        charset=" . $Databases[$Key]['encoding'],
                        $Databases[$Key]['username'],
                        $Databases[$Key]['password'],
                        [PDO::ATTR_PERSISTENT => false]
                    );
                } catch (PDOException $e) {
                    $ExceptionMessage = "<strong>Database Connection Exception Occurred</strong>" . PHP_NL;
                    $ExceptionMessage .= "<strong>Error Code:</strong> " . $e->getCode() . PHP_NL;
                    $ExceptionMessage .= "<strong>Error Message:</strong> " . $e->getMessage() . PHP_NL;
                    $ExceptionMessage .= "<strong>Error File:</strong> " . $e->getFile() . PHP_NL;
                    $ExceptionMessage .= "<strong>Error Line:</strong> " . $e->getLine() . PHP_NL;
                    $ExceptionMessage .= "<i>Error occurred during initiation of the connection to </i><strong>" . $Databases[$Key]['database'] . "</strong><i> database</i>";
                    die($ExceptionMessage);
                };
            } else {
                $Connections = ['Auth', 'Characters', 'World'];
                $Host = $Value['host'];
                $Port = $Value['port'];
                $User = $Value['username'];
                $Pass = $Value['password'];
                $AuthDatabase = $Value['auth'];
                $CharactersDatabase = $Value['characters'];
                $WorldDatabase = $Value['world'];
                $Encoding = $Value['encoding'];
                foreach($Connections as $Connection){
                    $VarName = $Connection.'Database';
                    try {
                        Database::$Connections[$Key][$Connection] = new PDO(
                            "mysql:host=".$Host.";
                            dbname=".$$VarName.";
                            charset=".$Encoding,
                            $User,
                            $Pass,
                            [PDO::ATTR_PERSISTENT => false]
                        );
                    } catch(PDOException $e){
                        $ExceptionMessage = "<strong>Database Connection Exception Occurred</strong>".PHP_NL;
                        $ExceptionMessage .= "<strong>Error Code:</strong> ".$e->getCode().PHP_NL;
                        $ExceptionMessage .= "<strong>Error Message:</strong> ".$e->getMessage().PHP_NL;
                        $ExceptionMessage .= "<strong>Error File:</strong> ".$e->getFile().PHP_NL;
                        $ExceptionMessage .= "<strong>Error Line:</strong> ".$e->getLine().PHP_NL;
                        $ExceptionMessage .= "<i>Error occurred during initiation of the connection to </i><strong>".$$VarName."</strong><i> database</i>";
                        die($ExceptionMessage);
                    };
                }
            }
        }

        foreach(Database::$Connections as $Key=>$Value)
            if(is_array(Database::$Connections[$Key]))
                foreach(Database::$Connections[$Key] as $IKey=>$IValue)
                    Database::$Connections[$Key][$IKey]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            else
                Database::$Connections[$Key]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Execute Plain Query With No Parameters
     * @param $Connection           - Connection Name
     * @param $Query                - Query To Be Executed
     */
    public static function plainSQL($Connection, $Query){
        Database::selectConnection($Connection);
        try{
            $Statement = Database::$SelectedConnection->prepare($Query);
            $Statement->execute();
        } catch (PDOException $e){
            $Message = Database::PDOExceptionMessage($e);
            die($Message);
        }
    }

    /**
     * Execute Plain Query With No Paramaters and PDO Object
     * @param $PDO
     * @param $Query
     */
    public static function plainSQLPDO(PDO $PDO, $Query){
        try {
            $Statement = $PDO->prepare($Query);
            $Statement->execute();
        } catch (PDOException $e){
            $Message = Database::PDOExceptionMessage($e);
            die($Message);
        }
    }

    /**
     * Get Single Row From Database
     * @param $Connection           - Connection Name
     * @param $Query                - Query To Be Executed
     * @param null $Parameters      - Parameters For The Query
     * @return mixed                - Returns PDO Array Object
     */
    public static function getSingleRow($Connection, $Query, $Parameters = null){
        Database::selectConnection($Connection);
        try{
            $Statement = Database::$SelectedConnection->prepare($Query);
            if($Parameters != null)
                foreach($Parameters as $Parameter)
                    $Statement->bindParam($Parameter['id'], $Parameter['value']);
            $Statement->execute();
            return $Statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e){
            $Message = Database::PDOExceptionMessage($e);
            die($Message);
        }
    }

    /**
     * Get Multiple Rows From Database
     * @param $Connection           - Connection Name
     * @param $Query                - Query To Be Executed
     * @param null $Parameters      - Parameters For The Query
     * @return mixed                - Returns PDO Array Object
     */
    public static function getMultiRow($Connection, $Query, $Parameters = null){
        Database::selectConnection($Connection);
        try{
            $Statement = Database::$SelectedConnection->prepare($Query);
            if($Parameters != null)
                foreach($Parameters as $Parameter)
                    $Statement->bindParam($Parameter['id'], $Parameter['value']);
            $Statement->execute();
            return $Statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e){
            $Message = Database::PDOExceptionMessage($e);
            die($Message);
        }
    }

    /**
     * Get Established Connections Names
     * @return array                - Returns Array Of Connections Names
     */
    public static function getConnections(){
        return array_keys(Database::$Connections);
    }

    /**
     * Checks If Performed Query Returned Any Results
     * @param $Statement            - Statement Used
     * @return bool                 - Empty or Not (True/False)
     */
    public static function isEmpty($Statement){
        if($Statement->rowCount() > 0)
            return false;
        else
            return true;
    }

    /**
     * Parses Configuration Array For Database Objects
     * @param $Configuration        - Configuration Array
     * @return array                - Parsed Database Objects
     */
    private static function getDatabaseLinks($Configuration){
        $DatabaseLinks = [];
        foreach($Configuration as $LinkName => $LinkData)
            if(isset($LinkData['Database']))
                $DatabaseLinks[$LinkName] = $LinkData['Database'];
        return $DatabaseLinks;
    }

    /**
     * Sets Connection To Be Used For Desired Query
     * @param $Connection           - Connection Name
     */
    private static function selectConnection($Connection){
        Database::$SelectedConnection = Database::$Connections[$Connection];
    }

    /**
     * Generate Custom PDO Exception Message To Be Displayed On Error
     * @param $Exception
     * @return string
     */
    private static function PDOExceptionMessage($Exception){
        $TraceData = $Exception->getTrace();
        $ExceptionMessage = "<strong>Database Connection Exception Occurred</strong>".PHP_NL;
        $ExceptionMessage .= "<strong>Error Code:</strong> ".$Exception->getCode().PHP_NL;
        $ExceptionMessage .= "<strong>Error Message:</strong> ".$Exception->getMessage().PHP_NL;
        $ExceptionMessage .= "<strong>Error File:</strong> ".$Exception->getFile().PHP_NL;
        $ExceptionMessage .= "<strong>Error Line:</strong> ".$Exception->getLine().PHP_NL.PHP_NL;
        $ExceptionMessage .= "<strong>Error Connection:</strong> ".$TraceData[1]['args'][0].PHP_NL;
        $ExceptionMessage .= "<strong>Error Query:</strong> ".$TraceData[1]['args'][1].PHP_NL;
        $ExceptionMessage .= "<strong>Error From:</strong> ".$TraceData[1]['file'].' (Line '.$TraceData[1]['line'].')'.PHP_NL;
        return $ExceptionMessage;
    }

    /**
     * Get Database Client Version
     * @return mixed
     */
    public static function ClientVersion()
    {
        ob_start();
        phpinfo(INFO_MODULES);
        $Info = ob_get_contents();
        ob_end_clean();
        $Info = stristr($Info, 'Client API version');
        preg_match('/[1-9].[0-9].[1-9][0-9]/', $Info, $Match);
        $Client = $Match[0];
        return $Client;
    }
}

global $FCCore, $Database, $InstallationInProgress;

$Database = new Database($FCCore);
$InstallationInProgress = true;

if(isset($FCCore['Website']['Database']['host']) && $FCCore['Website']['Database']['host'] != ''){
    if(!isset($_SESSION['installation_in_progress']))
        if(session_status() == PHP_SESSION_NONE){
            global $Session;
            $Session = new Session();
            $Session->startSimple();
        }

} else {
    session_start();
    $_SESSION['preferredlanguage'] = '';
    $_SESSION['installation_in_progress'] = true;
    if(strpos($_SERVER['REQUEST_URI'], '/Install') === false)
        header('Location: /Install');
}