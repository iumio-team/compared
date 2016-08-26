<?php

namespace Compared\Tools;

use GException\LoadingError;
use Compared\Services\YamlServices;
use Spyc;

class UtilityFunction {

    static protected $arrayDeveloper = array(), $arraySmart = array(), $arraySU = array();


    /** Translate word from english to french
     * 
     * @param String $word The word which need to translate
     * @return  String
     */
    static public function translateEnToFr(string $word) :string {
        switch ($word) {
            case 'Developer':
                return 'développeur';
            break;
            case 'ATTACHED':
                return 'Lié au comparateur';
            break;
            case 'NOTATTACHED':
                return 'Fonctionnalités de comparaison désactivés';
                break;

            default:
                break;
        }
    }

    /** Return the project root : Change the absolute route
     * @return string project root
     */
    static public function getRootProject()
    {
        return "/Applications/MAMP/htdocs/COMPARED/";
    }

    static public function getToday():Date\FrenchDate
    {
        $now = new Date\FrenchDate("now");
        return $now;
    }
    /**
     * Get File with all information about DATABASE , ORM , ENGINE COMPARATOR , ...
     * @return Array Informations
     * @throws LoadingError Error if YAML File is not load
     */ 
    static public function getMasterFile():array
    {
        $service = new YamlServices(self::getRootProject().'/PRIVATE/AppInfo.yml');
        $e = $service->start();
        if ($e == 1)
            return $service->getContent();
        else
            return array();
    }
    
    /**
     * Calculate average of smartphone score
     * @param Int $sum The score sum
     * @param Int $divisor Score number
     * @return float Average
     */
    static public function calculateAverage(int $sum, int $divisor):float
    {
            $result = 0;
            $result = $sum / $divisor ;
            return (round($result, 1));
    }

}
