<?php
//echo phpinfo();
/**
 * This files enables to make verification of app .
 * @since 0.09
 * @author RAFINA DANY <danyrafina@gmail.com>
 * @version 0.30
 * @php_version 7.00 RTM
 */
use GException\{LoadingError,EngineComparatorException,PDORNException,MaintenanceException};
use LayerConnector\MDA;

class Starter {

    public $isReady = 0;
    public $isMaintenance = 0;

    public function __construct()
    {
        $array = $this->initAutoloader();
        $this->__autoloader($array);
        $this->initTwig();
        $this->isMaintenance();
        $this->verifyDatabase();
        $this->initApp();
        $this->isComparatorAvailable();
    }
    
    
    private function __autoloader($array) {
        include_once 'Autoloader.php';
        foreach ($array as $one) {
            Autoloader::register ($one);
        }
    }
  
    public function isMaintenance() {
         $yamlFile = $this->getMasterFile();
         $isM = $yamlFile['MAINTENANCE'];
         if($isM['MAINTENANCE_MODE'] == "ENABLED"){
             $this->isReady = 0 ;
             $this->isMaintenance = 1;
             throw new MaintenanceException("Maintenance de COMPARED");
         }
         else {
             $this->isReady = 1;
             $this->isMaintenance = 0;
         }
    }
    protected function initAutoloader(){
        try {
         $this->initYamlAutoloader();
         $array = $_SESSION['AUTOLOADER']['REGISTER_AUTOLOADER'];
            $this->isReady = 1;
         return  $array;
            
            
        } catch (Exception $exc) {
            $this->isReady = 0;
            $error = "Erreur d'execution de l'autoloader ";
            include 'VIEWS/viewError.html.twig';
        }

       
    }

    public function isComparatorAvailable() {
        $yamlFile = $this->getMasterFile();
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
        if (is_array($message) && isset($message[0]) && $message[0] == 'ISAVAILABLE' )
            $this->isReady = 1;
        else if ($this->isComparatorLink() == false)
            $this->isReady = 1;
        else {
            $this->isReady = 0;
            throw new EngineComparatorException("Impossible de lier COMPARED au moteur de comparaison [ERROR " . $message->code . "]");
        }
    }

    public function isComparatorLink() {
        $yamlFile = $this->getMasterFile();
        $info = $yamlFile['ENGINE_COMPARATOR']['LINK'];
        return ($info === "NOTATTACHED")? false : true;
    }
    
    public function getMasterFile() {
        try {
            return Spyc::YAMLLoad('PRIVATE/AppInfo.yml');
        } catch (Exception $ex) {
            throw new LoadingError('Erreur de chargement du module YAML');
        }
    }
    public function linkAppToComparator() {
        $yamlFile = $this->getMasterFile();
        $url = $yamlFile['ENGINE_COMPARATOR']['LINK_TO_ENGINE_COMPARATOR'];
        $data = array('Action' => 'linkCToA', 'key' => $yamlFile['ENGINE_COMPARATOR']['Token'], 'ORM' => $yamlFile['ORM'], 'appname' => $yamlFile["APP_NAME"]);
        $ch = curl_init($url);
        $post = http_build_query($data, '', '&');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $message = json_decode($response);
        if (is_array($message) && isset($message[0]) && $message[0] == 'ISAVAILABLE')
            $this->isReady = 1;
        else {
            $this->isReady = 0;
            return $message;
        }
    }

    private function verifyDatabase() {
        try {
            $result = MDA::checkAdministrator();
            if ($result)
                $this->isReady = 1;
            else {
                new PDORNException("Une erreur a été généré par COMPARED : Vous ne pouvez pas utiliser l'application COMPARED sans administrateur");
                $this->isReady = 0;
            }
        } catch (Exception $ex) {
            new PDORNException('Une erreur a été généré par COMPARED : Erreur de base de donnée ', NULL, NULL);
            $this->isReady = 0;
        }
    }

    private function initApp() {
        if (file_exists('Pointer.php')) {
            $this->isReady = 1;
            if (class_exists('Pointer'))
                $this->isReady = 1;
            else {
                $this->isReady = 0;
                $loadingError = "Erreur de chargement du routeur de l'application";
                throw new LoadingError($loadingError);
            }
        }
        else {

            $this->isReady = 0;
            $loadingError = "Erreur d'importation du routeur de l'application";
            throw new LoadingError($loadingError);
        }
    }

    protected function initTwig() {
        try {
            Twig_Autoloader::register();
            $_SESSION['twig'] = new Twig_Environment(new Twig_Loader_Filesystem('VIEWS_DEV'), array('cache' => false,'debug'=>true));
            $this->isReady = 1;
        } catch (Exception $e) {
            $this->isReady = 0;
            $error = "Twig n'est pas disponible";
            include 'VIEWS/viewError.html.twig';
        }
    }

    
     protected function initYamlAutoloader() {
        try {
            include('ENGINE_YAML/Spyc.php');
            $_SESSION['AUTOLOADER'] = Spyc::YAMLLoad('PRIVATE/ClassAutoloader.yml');
            $this->isReady = 1;
        } catch (Exception $ex) {
            $this->isReady = 0;
            $error = "Erreur d'execution du moteur yaml";
            include 'VIEWS/viewError.html.twig';
        }
    }

}
