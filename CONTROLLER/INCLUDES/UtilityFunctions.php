<?php

use GException\LoadingError;
class UtilityFunction {

    static protected $arrayDeveloper = array(), $arraySmart = array(), $arraySU = array();

    static public function objectsStand() {

        /*
         * This method make a objects lists
         * After it seralizes all object list to reuse  
         */



        //$arrayUser = MDA::getUsers();

        for ($i = 0; $i < count($arrayUser); $i++) {

            switch ($arrayUser[$i]['nameUT']) {

                case 'Developer':

                    array_push(self::$arrayDeveloper, new Developer($arrayUser[$i]['idU'], $arrayUser[$i]['pseudoU'], $arrayUser[$i]['passwordU'], $arrayUser[$i]['firstNameU'], $arrayUser[$i]['lastName'], $arrayUser[$i]['emailU'], $arrayUser[$i]['pictureU'], $arrayUser[$i]['nameUT']));

                    break;

                case 'SimpleUser':

                    array_push(self::$arraySU, new SimpleUser($arrayUser[$i]['idU'], $arrayUser[$i]['pseudoU'], $arrayUser[$i]['passwordU'], $arrayUser[$i]['firstNameU'], $arrayUser[$i]['lastName'], $arrayUser[$i]['emailU'], $arrayUser[$i]['pictureU'], $arrayUser[$i]['nameUT']));

                    break;
            }
        }

        $a = serialize(1);

        echo $a;
    }

    /** Translate word from english to french
     * 
     * @param String $word The word which need to translate
     */
    static public function translateEnToFr($word) {
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

}
