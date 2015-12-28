<?php
namespace Core\Extensions\API;
use Core\Extensions\FreedomNetAPI as FreedomNetAPI;
use Core\Libraries\FreedomCore\System\Database as Database;
use \PDO as PDO;

class AccountAPI extends FreedomNetAPI{

    protected $Connection;
    protected $isAPIKeyRequired = true;

    /**
     * Which Fields Cannot Be Selected From Table
     * @var array
     */
    protected $Restrictions = [
        'users' => ['password']
    ];

    /**
     * AccountAPI constructor.
     */
    public function __construct(){
        $this->Connection = Database::$Connections['Database'];
    }

    /**
     * Account API Method to get current users balance
     * @return array
     */
    protected function getBalance(){
        $AccountID = 1;
        $Currencies = ['USD', 'EUR', 'CAD', 'SGD', 'RUB'];
        $BalanceArray = $this->setTable('users')
                        ->addArgument('balance')
                        ->addArgument('selected_currency')
                        ->addColumn('id')
                        ->addParameter([':userid', $AccountID])
                        ->build()
                        ->single();

        $FinalArray = ['base' => ['currency' => $BalanceArray['selected_currency'], 'balance' => $BalanceArray['balance']], 'conversion' => []];
        foreach($Currencies as $Currency)
            if($Currency != $BalanceArray['selected_currency'])
                $FinalArray['conversion'][] = ['currency' => $Currency, 'balance' => $this->getCurrencyConvert([$BalanceArray['selected_currency'], $Currency, $BalanceArray['balance']])['result']];
        return $FinalArray;
    }

    protected function getInfo($Arguments){
        if(!empty($Arguments)){
            if($this->checkForUserName($Arguments[0])){
                $Username = $Arguments[0];
                unset($Arguments[0]);
                $AccountData = $this->setTable('users')
                    ->addArguments($Arguments)
                    ->addColumn('username')
                    ->addParameter([':username', $Username])
                    ->build()
                    ->single();
            } else {
                $AccountData = $this->setTable('users')
                    ->addArguments($Arguments)
                    ->addColumn('username')
                    ->addParameter([':username', 'darki73']) // TODO: Replace My Username With Account One
                    ->build()
                    ->single();
            }
        } else {
            $AccountData = $this->setTable('users')
                ->addArguments('id, username, email, registration_date, freedomtag_name, freedomtag_id')
                ->addColumn('username')
                ->addParameter([':username', 'darki73']) // TODO: Replace My Username With Account One
                ->build()
                ->single();
        }
        return $AccountData;
    }

    /**
     * Account API Currency Convertor Functionality
     * @param $Arguments
     * @return array|mixed
     */
    protected function getCurrencyConvert($Arguments){
        if(count($Arguments) > 3)
            return json_decode(parent::generateResponse('Too many arguments', 400), true);

        $From = $Arguments[0];
        $To = $Arguments[1];
        $Amount = $Arguments[2];
        $Converter = new CurrencyConverter($From, $To);
        return ['result' => $Converter->toForeign($Amount)];
    }
}

class CurrencyConverter
{
    private $fxRate;

    public function __construct($currencyBase, $currencyForeign)
    {
        $url = 'http://download.finance.yahoo.com/d/quotes.csv?s='
            .$currencyBase .$currencyForeign .'=X&f=l1';

        $c = curl_init($url);
        curl_setopt($c, CURLOPT_HEADER, 0);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        $this->fxRate = doubleval(curl_exec($c));
        curl_close($c);
    }

    public function toBase($amount)
    {
        if($this->fxRate == 0)
            return 0;

        return  $amount / $this->fxRate;
    }

    public function toForeign($amount)
    {
        if($this->fxRate == 0)
            return 0;

        return $amount * $this->fxRate;
    }
}