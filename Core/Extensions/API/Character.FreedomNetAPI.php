<?php
namespace Core\Extensions\API;
use Core\Extensions\FreedomNetAPI as FreedomNetAPI;
use Core\Libraries\FreedomCore\System\Database as Database;
use \PDO as PDO;

class CharacterAPI extends FreedomNetAPI{

    protected $Connection;

    public function __construct(){
        $this->Connection = Database::$Connections['CharDB'];
    }

    protected function getCount(){
        $Statement = $this->Connection->prepare('SELECT count(*) as result FROM characters');
        $Statement->execute();
        return $Statement->fetch(PDO::FETCH_ASSOC);
    }

    protected function getList($Arguments = []){
        if(empty($Arguments))
            $Query = 'SELECT * FROM characters';
        else
            $Query = 'SELECT '.implode(', ', $Arguments).' FROM characters';
        $Statement = $this->Connection->prepare($Query);
        $Statement->execute();
        return $Statement->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getArguments($Arguments){
        return $Arguments;
    }

    protected function getAppearance($Arguments){
        if(count($Arguments) > 1)
            return json_decode(parent::generateResponse('Too many arguments', 400), true);
        elseif(count($Arguments) == 0)
            return json_decode(parent::generateResponse('Not enough arguments', 400), true);

        $CharacterName = ucfirst(strtolower($Arguments[0]));
        $CharData = $this->setTable('characters')
            ->addArguments('name, class, race, gender, level, logout_time, playerBytes, playerBytes2, totalKills')
            ->addColumn('name')
            ->addParameter([':charname', $CharacterName])
            ->build()
            ->single();

        $PlayerBytes = $CharData['playerBytes'];
        $PlayerBytes2 = $CharData['playerBytes2'];
        unset($CharData['playerBytes']);
        unset($CharData['playerBytes2']);
        $Appearance = [
            'faceVariation'     =>  ($PlayerBytes >> 8) % 256,
            'skinColor'         =>  $PlayerBytes % 256,
            'hairVariation'     =>  ($PlayerBytes >> 16) % 256,
            'hairColor'         =>  ($PlayerBytes >> 24)%256,
            'featureVariation'  =>  $PlayerBytes2 % 256
        ];
        $CharData['faction'] = $this->sideByRaceID($CharData['race']);
        $CharData['appearance'] = $Appearance;
        $CharData['totalHonorableKills'] = $CharData['totalKills'];
        unset($CharData['totalKills']);
        return $CharData;
    }

    private function sideByRaceID($RaceID)
    {
        $HordeRaces = array(2, 5, 6, 8, 9, 10, 26);
        if(in_array($RaceID, $HordeRaces))
            return 1;
        else
            return 0;
    }
}