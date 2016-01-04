<?php

use GException\LoadingError;
class UtilityFunction {

    static protected $arrayDeveloper = array(), $arraySmart = array(), $arraySU = array();


    /** Translate word from english to french
     * 
     * @param String $word The word which need to translate
     * @return  String
     */
    static public function translateEnToFr($word) :string {
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
    
    /**
     * Get File with all information about DATABASE , ORM , ENGINE COMPARATOR , ...
     * @return Array Informations
     * @throws LoadingError Error if YAML File is not load
     */ 
    static public function getMasterFile() {
        try {
            
            if(file_exists('./PRIVATE/AppInfo.yml')){
                return Spyc::YAMLLoad('./PRIVATE/AppInfo.yml');
            }
            else {
                return Spyc::YAMLLoad('../PRIVATE/AppInfo.yml');
            }
           
        } catch (Exception $ex) {
            throw new LoadingError('Erreur de chargement du module YAML');
        }
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
            return (round($result,1));
        }

}
