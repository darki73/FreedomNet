<?php

namespace Core\Extensions;
use \Exception as Exception;
use \Core\Libraries\FreedomCore\System\Database as Database;
use \PDO as PDO;

class FreedomNetAPI {

    /**
     * The HTTP method this request was made in, either GET, POST, PUT or DELETE
     * @var string
     */
    protected $Method               = '';

    /**
     * The Model requested in the URI. eg: /characters/count
     * @var string
     */
    protected $Endpoint             = '';

    /**
     * An optional additional descriptor about the endpoint, used for things that can
     * not be handled by the basic methods
     * @var string
     */
    protected $Descriptor           = '';

    /**
     * Any additional URI components after the endpoint
     * @var array
     */
    protected $Arguments            = [];

    /**
     * Class which will be used during API Requests
     * @var string
     */
    protected $APIClass             = '';

    /**
     * Method name to use during API Request
     * @var string
     */
    protected $APIMethod            = '';

    /**
     * API File to be loaded in order to be able to use API
     * @var string
     */
    protected $APIFile              = '';

    /**
     * Holds API Object after its been initialized
     * @var string
     */
    protected $APIObject            = '';

    /**
     * Storing Request Variables
     * @var array
     */
    protected $Request              = [];

    /**
     * Checks if API Key is Required To Run Selected API Methods
     * @var bool
     */
    protected $isAPIKeyRequired     = false;

    protected $SelectedTable = '';
    protected $TArguments = [];
    protected $Columns = [];
    protected $Parameters = [];
    protected $Connection;
    protected $FinalStatement;

    /**
     * FreedomNetAPI constructor.
     * @param $FullRequest
     * @throws Exception Unexpected Header
     */
    public function __construct($FullRequest){
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header('Content-Type: application/json; charset=utf-8');

        $Request = $FullRequest['request'];
        $this->Arguments = explode('/', rtrim($Request, '/'));
        $this->Endpoint = array_shift($this->Arguments);
        $this->Request = $FullRequest;

        if (array_key_exists(0, $this->Arguments) && !is_numeric($this->Arguments[0]))
            $this->Descriptor = array_shift($this->Arguments);
        $this->Method = $_SERVER['REQUEST_METHOD'];

        $this->APIClass = ucfirst($this->Endpoint).'API';
        if(!strstr($this->Descriptor, '-'))
            $this->APIMethod = strtolower($this->Method).ucfirst($this->Descriptor);
        else {
            $Exploded = explode('-', $this->Descriptor);
            $Method = strtolower($this->Method);
            foreach($Exploded as $Item)
                $Method .= ucfirst($Item);
            $this->APIMethod = $Method;
        }
        $this->APIFile = ucfirst($this->Endpoint).'.FreedomNetAPI.php';

        if ($this->Method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER))
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE')
                $this->Method = 'DELETE';
            else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT')
                $this->Method = 'PUT';
            else
                throw new Exception("Unexpected Header");

        switch($this->Method) {
            case 'DELETE':
            case 'POST':
                $this->request = $this->cleanInputs($_POST);
                break;
            case 'GET':
                $this->request = $this->cleanInputs($_GET);
                break;
            case 'PUT':
                $this->request = $this->cleanInputs($_GET);
                $this->file = file_get_contents("php://input");
                break;
            default:
                $this->generateResponse('Invalid Method', 405);
                break;
        }
        $this->loadAPI();
    }

    /**
     * Process API Request
     * @return string
     */
    public function processAPI() {
        if($this->isAPIKeyRequired && !isset($this->Request['api_key']))
            return $this->generateResponse('In order to use this Enpoint, you need to provide API Key', 401);
        if(method_exists($this->APIObject, $this->APIMethod))
            return $this->generateResponse(call_user_func_array([$this->APIObject, $this->APIMethod], [$this->Arguments]));

        return $this->generateResponse("Endpoint ".ucfirst($this->Endpoint)." does not have method ".ucfirst($this->Descriptor)." accessible through $this->Method Request", 501);
    }

    /**
     * Clear Input
     * @param $Data
     * @return array|string
     */
    private function cleanInputs($Data) {
        $CleanInput = [];
        if (is_array($Data))
            foreach ($Data as $Key => $Value)
                $CleanInput[$Key] = $this->cleanInputs($Value);
        else
            $CleanInput = trim(strip_tags($Data));

        return $CleanInput;
    }

    /**
     * Generate Response in JSON Format
     * @param $data
     * @param int $status
     * @return string
     */
    public function generateResponse($data, $status = 200) {
        $JSONData = ['response' => $status, 'result' => $data];
        if(isset($this->Request['suppress_response_code']) && $this->Request['suppress_response_code'] == 'true')
            $status = 200;
        header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
        return json_encode($JSONData);
    }

    /**
     * Generate Request Status
     * @param $Code
     * @return mixed
     */
    private function requestStatus($Code) {
        $Status = [
            200 => 'OK',
            201 => 'Created',
            304 => 'Not Modified',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            429 => 'Too Many Requests',
            500 => 'Internal Server Error',
            501 => 'Not Implemented'
        ];
        return ($Status[$Code])?$Status[$Code]:$Status[500];
    }

    /**
     * Load API Class
     * @throws Exception
     */
    private function loadAPI(){
        $FilePath = realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR.'API'.DIRECTORY_SEPARATOR;
        $APIFile = $FilePath.$this->APIFile;
        if(file_exists($APIFile)){
            require_once($APIFile);
            $ClassName = 'Core\\Extensions\\API\\'.$this->APIClass;
            $this->APIObject = new $ClassName;
            $this->isAPIKeyRequired = $this->APIObject->isAPIKeyRequired;
            $this->Connection = $this->APIObject->Connection;
        }
        else
            throw new Exception(ucfirst($this->Endpoint)." API Model not found!");
    }


    /**
     * Set Table Name To Be Used
     * @param $TableName
     * @return $this
     */
    protected function setTable($TableName){
        $this->SelectedTable = $TableName;
        return $this;
    }

    /**
     * Add Argument To Be Used During Query Execution
     * @param $Argument
     * @return $this
     */
    protected function addArgument($Argument){
        $this->TArguments[] = $Argument;
        return $this;
    }

    /**
     * Mass Define Arguments
     * @param $Arguments
     * @return $this
     */
    protected function addArguments($Arguments){
        if(is_array($Arguments))
            $this->TArguments = $Arguments;
        else
            $this->TArguments = explode(',', str_replace(' ', '', $Arguments));
        return $this;
    }

    /**
     * Add Column Which must be used in order to match the parameters
     * @param $Column
     * @return $this
     */
    protected function addColumn($Column){
        $this->Columns[] = $Column;
        return $this;
    }

    /**
     * Add Parameter To The Array
     * @param $Parameter
     * @return $this
     */
    protected function addParameter($Parameter){
        $this->Parameters[] = $Parameter;
        return $this;
    }

    /**
     * Get Single Row From Database
     * @return mixed
     * @throws \Exception
     */
    protected function build(){
        foreach($this->TArguments as $Argument)
            if(isset($this->APIObject->Restrictions))
                if(in_array($Argument, $this->APIObject->Restrictions[$this->SelectedTable]))
                    throw new \Exception('This parameter {'.$Argument.'} cannot be selected from database!');

        $Query = 'SELECT '.implode(', ', $this->TArguments).' FROM '.$this->SelectedTable.' WHERE ';
        if($this->Parameters != null)
            foreach($this->Parameters as $Key => $Parameter)
                if(count($this->Columns) == $Key + 1)
                    $Query .= $this->Columns[$Key].' = '.$Parameter[0].';';
                else
                    $Query .= $this->Columns[$Key].' = '.$Parameter[0].' AND ';
        $this->FinalStatement = $this->Connection->prepare($Query);
        if($this->Parameters != null)
            foreach($this->Parameters as $Key => $Parameter)
                $this->FinalStatement->bindParam($Parameter[0], $Parameter[1]);
        $this->FinalStatement->execute();
        if(Database::IsEmpty($this->FinalStatement))
            return json_decode($this->generateResponse('No Results Found', 404), true);
        return $this;
    }

    protected function single(){
        return $this->FinalStatement->fetch(PDO::FETCH_ASSOC);
    }

    protected function multiple(){
        return $this->FinalStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function checkForUserName($Username){
        $Statement = $this->Connection->prepare('SELECT id, username FROM users WHERE username = :username');
        $Statement->bindParam(':username', $Username);
        $Statement->execute();
        if(Database::IsEmpty($Statement))
            return false;
        return true;
    }

}