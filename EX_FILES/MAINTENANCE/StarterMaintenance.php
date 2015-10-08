<?php

/**
 * This files enables to make verification of app .
 * @since 0.12
 * @author RAFINA DANY <danyrafina@gmail.com>
 */
use GException\LoadingError;
use GException\EngineComparatorException;
use GException\PDORNException;
use LayerConnector\Queries;
use GException\MaintenanceException;

class StarterMaintenance {

    public static $isReady = 0;
    public static $isMaintenance=0;

    public static function switchOnApp() {
        $a = new StarterMaintenance();
        $array = $a->initAutoloader();
        $a->__autoloader($array);
        $a->initTwig();
        $a->initYaml();
        $a->verifyDatabase();
        $a->initApp();
        self::isComparatorAvailable();
        }
    
    
    public function __autoloader($array) {
        include_once '../Autoloader.php';
        foreach ($array as $one) {
            Autoloader::register ($one);
        }
    }
  
    public function isMaintenance() {
         $yamlFile = $_SESSION['APP_INFO'];
         $isM = $yamlFile['MAINTENANCE'];
         if($isM['MAINTENANCE_MODE'] == "ENABLED"){
             self::$isReady =0;
             self::$isMaintenance=1;
             throw new MaintenanceException("Maintenance de COMPARED");
           
         }
         else {
             self::$isReady =1;
              self::$isMaintenance=0;
         }
    }
    public function initAutoloader(){
        try {
         self::initYamlAutoloader();
         $array = $_SESSION['AUTOLOADER']['REGISTER_AUTOLOADER'];
         self::$isReady =1;
         return  $array;
            
            
        } catch (Exception $exc) {
            self::$isReady = 0;
            $error = "Erreur d'execution de l'autoloader ";
            include 'VIEWS/viewError.html.twig';
        }

       
    }

   public static function isComparatorAvailable() {
        $yamlFile = $_SESSION['APP_INFO'];
        $url = $yamlFile['ENGINE_COMPARATOR']['LINK_TO_ENGINE_COMPARATOR'];
        $data = array('Action' => 'ISAVAILABLE', 'key' => $yamlFile['ENGINE_COMPARATOR']['Token'], 'ORM' => $yamlFile['ORM'], 'appname' => $yamlFile["APP_NAME"]);
        $ch = curl_init($url);
        $post = http_build_query($data, '', '&');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $message = json_decode($response);
        if (is_array($message) && isset($message[0]) && $message[0] == 'ISAVAILABLE' ) {
            
            static::$isReady = 1;
        }
        else if(self::isComparatorLink() == false){
            static::$isReady = 1;
        }
        else {
            static::$isReady = 0;
                throw new EngineComparatorException("Impossible de lier COMPARED au moteur de comparaison [ERROR " . $message->code . "]");
        }
    }

    public static function linkAppToComparator() {
        $yamlFile = $_SESSION['APP_INFO'];
        $url = $yamlFile['LINK_TO_ENGINE_COMPARATOR'];
        $data = array('Action' => 'linkCToA', 'key' => $yamlFile['Token'], 'ORM' => $yamlFile['ORM'], 'appname' => $yamlFile["APP_NAME"]);
        $ch = curl_init($url);
        $post = http_build_query($data, '', '&');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $message = json_decode($response);
        if (is_array($message) && isset($message[0]) && $message[0] == 'ISAVAILABLE') {
            static::$isReady = 1;
        } else {
            static::$isReady = 0;
            return $message;
        }
    }

    public function verifyDatabase() {
        try {
            $result = Queries::checkAdministrator();
            if ($result) {
                static::$isReady = 1;
            } else {
                new PDORNException("Une erreur a été généré par COMPARED : Vous ne pouvez pas utiliser lapplication COMPARED sans administrateur");
                static::$isReady = 0;
            }
        } catch (Exception $ex) {
            new PDORNException('Une erreur a été généré par COMPARED : Erreur de base de donnée ', NULL, NULL);
            static::$isReady = 0;
        }
    }

    public function initApp() {
        if (file_exists('Router.php')) {
            static::$isReady = 1;
            if (class_exists('Router')) {
                static::$isReady = 1;
                
            } else {

                static::$isReady = 0;
                $loadingError = "Erreur de chargement du routeur de l'application";
                throw new LoadingError($loadingError);
            }
        } else {

            static::$isReady = 0;
            $loadingError = "Erreur d'importation du routeur de l'application";

            throw new LoadingError($loadingError);
        }
    }

    public function initTwig() {
        try {
            Twig_Autoloader::register();
            $_SESSION['twigLoader'] = new Twig_Loader_Filesystem('VIEWS');

            $_SESSION['twig'] = new Twig_Environment($_SESSION['twigLoader'], array('cache' => false,'debug'=>true));
           
            
            static::$isReady = 1;
            
        } catch (Exception $e) {
            static::$isReady = 0;
            $error = "Twig n'est pas disponible";
            include 'VIEWS/viewError.html.twig';
        }
    }

    public function initYaml() {

        try {
            $_SESSION['APP_INFO'] = Spyc::YAMLLoad('../PRIVATE/AppInfo.yml');
            static::$isReady = 1;
        } catch (Exception $ex) {
            static::$isReady = 0;
            throw new LoadingError('Erreur de chargement du module YAML');
        }
    }
     public static function initYamlAutoloader() {
        try {
            include('../ENGINE_YAML/Spyc.php');
            $_SESSION['AUTOLOADER'] = Spyc::YAMLLoad('../PRIVATE/ClassAutoloader.yml');
            static::$isReady = 1;
        } catch (Exception $ex) {
            static::$isReady = 0;
            $error = "Erreur d'execution du moteur yaml";
            include 'VIEWS/viewError.html.twig';
        }
    }

}
