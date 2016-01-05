<?php
namespace Core\Extensions;

use Core\Libraries\FreedomCore\System\Database as Database;
use Core\Extensions\DatabaseManager as DatabaseManager;
use Core\Libraries\FreedomCore\System\Text;

class Account {

    /**
     * Templates Manager Object (Smarty)
     * @var
     */
    private $TM = null;

    /**
     * Database Manager Object
     * @var null
     */
    private $DBManager = null;

    /**
     * Website Database PDO Object
     * @var null
     */
    protected $Connection = null;

    /**
     * Auth Database PDO Object
     * @var null
     */
    protected $AuthConnection = null;

    /**
     * Characters Database PDO Object
     * @var null
     */
    protected $CharConnection = null;

    /**
     * World Database PDO Object
     * @var null
     */
    protected $WorldConnection = null;

    /**
     * Account constructor.
     * @param $Database
     * @param $TemplatesManager
     */
    public function __construct($TemplatesManager){
        $this->TM = $TemplatesManager;
        $this->Connection = Database::$Connections['Website'];
        $this->DBManager = new DatabaseManager();
    }

    /**
     * Populate Connection Variables With PDO Objects Of Given Database
     * @param $Database
     */
    public function selectGameDatabase($Database){
        $this->AuthConnection = Database::$Connections[$Database]['auth'];
        $this->CharConnection = Database::$Connections[$Database]['characters'];
        $this->WorldConnection = Database::$Connections[$Database]['world'];
    }


    /**
     * Get User Balance
     * @param $Username
     * @param bool|false $isJson
     * @return mixed|string
     */
    public function getBalance($Username, $isJson = false){
        $Result = $this->DBManager->setTableName('users')
            ->selectColumns('selected_currency, balance')
            ->addCondition('username', '=', ':username')
            ->addRelation('username', $Username)
            ->select()->executePDO($this->Connection, true);
        if($isJson)
            return json_encode($Result, JSON_UNESCAPED_UNICODE);
        else
            return $Result;
    }
}