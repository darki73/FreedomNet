<?php
namespace Core\Libraries\FreedomCore\System;

class Session {

    private $Connection;
    private $isCreated = false;
    private $Salt;

    /**
     * Add Items To The Session Variable
     * @param $SessionData
     */
    public function updateSession($SessionData){
        if(session_status() != PHP_SESSION_NONE)
            foreach($SessionData as $ItemKey => $ItemValue)
                $_SESSION[$ItemKey] = $ItemValue;
    }

    /**
     * Checks If Session Has Already Been Created
     * @return bool
     */
    public function getSessionStatus(){
        if(session_status() == PHP_SESSION_NONE)
            return false;
        return true;
    }

    /**
     * Generate Random Session Salt
     * @return string
     */
    private function generateRandomSalt(){
        $AvailableCharacters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*+|/-";
        $CharactersLength = strlen($AvailableCharacters);
        $RandomString = "";
        for($i = 0; $i < $CharactersLength; $i++)
            $RandomString .= $AvailableCharacters[rand(0, $CharactersLength - 1)];
        return $RandomString;
    }

    /**
     * Generate CSRF Token
     * @return string
     */
    public function generateCSRFToken(){
        $InitialString = "abcdefghijklmnopqrstuvwxyz1234567890";
        $PartOne = substr(str_shuffle($InitialString),0,8);
        $PartTwo = substr(str_shuffle($InitialString),0,4);
        $PartThree = substr(str_shuffle($InitialString),0,4);
        $PartFour = substr(str_shuffle($InitialString),0,4);
        $PartFive = substr(str_shuffle($InitialString),0,12);
        $FinalCode = $PartOne.'-'.$PartTwo.'-'.$PartThree.'-'.$PartFour.'-'.$PartFive;
        $_SESSION['generated_csrf'] = $FinalCode;
        return $FinalCode;
    }

    /**
     * Checks If Session Token And Provided Token Matches
     * @param $Token
     * @return bool
     */
    public function validateCSRFToken($Token){
        if(isset($Token) && $Token == $_SESSION['generated_csrf']){
            $this->unsetKeys('generated_csrf');
            return true;
        }

        return false;
    }

    /**
     * Removes Keys From Session Array
     * @param $Keys
     */
    public function unsetKeys($Keys){
        if(array($Keys))
            foreach($Keys as $Key)
                unset($_SESSION[$Key]);
        else
            unset($_SESSION[$Keys]);
    }

    /**
     * Creates Simple Session
     */
    public function startSimple(){
        session_start();
        $this->isCreated = true;
    }

    /**
     * Destroys Simple Session
     */
    public function destroySimple(){
        $this->isCreated = false;
        setcookie('FreedomNetLanguage', null, time()-3600);
        setcookie('FreedomNet', null, time()-3600);
        session_destroy();
    }


}