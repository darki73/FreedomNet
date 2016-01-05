<?php
namespace Core\Extensions;

use Core\Libraries\FreedomCore\System\Database as Database;

class User {

    /**
     * Templates Manager Object (Smarty)
     * @var
     */
    protected $TM = null;

    /**
     * Website Database Connection
     * @var
     */
    protected $Connection = null;

    /**
     * User Authorization Status
     * @var bool
     */
    protected $isAuthorized = false;

    /**
     * User ID
     * @var
     */
    protected $UserID = null;

    /**
     * User Username
     * @var
     */
    protected $Username = null;

    /**
     * User Email
     * @var
     */
    protected $Email = null;

    /**
     * Pinned Character To Be Displayed As Main In Userplate
     * @var
     */
    protected $PinnedCharacter = null;

    /**
     * User Access Level
     * @var
     */
    protected $AccessLevel = null;

    /**
     * User FreedomTag Data
     * @var array
     */
    protected $FreedomTag = ['name' => null, 'id' => null];

    /**
     * User Balance Data
     * @var array
     */
    protected $Balance = ['currency' => null, 'amount' => null];

    /**
     * User constructor.
     * @param $TemplatesManager - Smarty Object
     */
    public function __construct($TemplatesManager){
        $this->TM = $TemplatesManager;
        $this->Connection = Database::$Connections['Website'];
    }


    /**
     * Mass Define Essential User Data
     * @param $UserID
     * @param $Username
     * @param $Email
     * @param $AccessLevel
     * @param string $BalanceCurrency
     * @param int $BalanceAmount
     * @param bool|false $FreedomTagName
     * @param bool|false $FreedomTagID
     * @param bool|false $PinnedCharacter
     */
    public function setEssentials($UserID, $Username, $Email, $AccessLevel, $BalanceCurrency = 'USD', $BalanceAmount = 0, $FreedomTagName = false, $FreedomTagID = false, $PinnedCharacter = false){
        $this->setUserID($UserID);
        $this->setUsername($Username);
        $this->setEmail($Email);
        $this->setAccessLevel($AccessLevel);
        $this->setBalance($BalanceCurrency, $BalanceAmount);
        if($FreedomTagID != false)
            $this->setFreedomTag($FreedomTagName, $FreedomTagID);
        if($PinnedCharacter != false)
            $this->setPinnedCharacter($PinnedCharacter);
    }

    /**
     * Get All Essential User Data
     * @return array
     */
    public function getEssentials(){
        return [
            'id'                =>  $this->getUserID(),
            'username'          =>  $this->getUsername(),
            'email'             =>  $this->getEmail(),
            'access_level'      =>  $this->getAccessLevel(),
            'freedom_tag'        =>  $this->getFreedomTag(),
            'balance'           =>  $this->getBalance(),
            'pinned_character'  =>  $this->getPinnedCharacter()
        ];
    }

    /**
     * Get User Authorization Status
     * @return bool
     */
    public function getAuthorizationStatus(){
        return $this->isAuthorized;
    }

    /**
     * Set User Authorization Status
     * @param $Status
     */
    public function setAuthorizationStatus($Status){
        $this->isAuthorized = (boolean)$Status;
    }

    /**
     * Get Current Users Username
     * @return mixed
     */
    public function getUsername(){
        return $this->Username;
    }

    /**
     * Set Username For Current User
     * @param $Username
     */
    public function setUsername($Username){
        $this->Username = $Username;
    }

    /**
     * Set User ID
     * @return mixed
     */
    public function getUserID(){
        return $this->UserID;
    }

    /**
     * Get User ID
     * @param $ID
     */
    public function setUserID($ID){
        $this->UserID = $ID;
    }

    /**
     * Get User Email
     * @return mixed
     */
    public function getEmail(){
        return $this->Email;
    }

    /**
     * Set User Email
     * @param $Email
     */
    public function setEmail($Email){
        $this->Email = $Email;
    }

    /**
     * Get User Pinned Character
     * @return mixed
     */
    public function getPinnedCharacter(){
        return $this->PinnedCharacter;
    }

    /**
     * Set User Pinned Character
     * @param $PinnedCharacter
     */
    public function setPinnedCharacter($PinnedCharacter){
        $this->PinnedCharacter = $PinnedCharacter;
    }

    /**
     * Get User Access Level
     * @return mixed
     */
    public function getAccessLevel(){
        return $this->AccessLevel;
    }

    /**
     * Set User Access Level
     * @param $AccessLevel
     */
    public function setAccessLevel($AccessLevel){
        $this->AccessLevel = $AccessLevel;
    }

    /**
     * Get User FreedomTag Data
     * @return array
     */
    public function getFreedomTag(){
        return $this->FreedomTag;
    }

    /**
     * Set User FreedomTag Data
     * @param $Name
     * @param $ID
     */
    public function setFreedomTag($Name, $ID){
        $this->FreedomTag = ['name' => $Name, 'id' => $ID];
    }

    /**
     * Get User Balance
     * @return array
     */
    public function getBalance(){
        return $this->Balance;
    }

    /**
     * Set User Balance
     * @param $Currency
     * @param $Amount
     */
    public function setBalance($Currency, $Amount){
        $this->Balance = ['currency' => $Currency, 'amount' => $Amount];
    }
}