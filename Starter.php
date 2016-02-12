<?php
/**
 * This files enables to make verification of app .
 * @since 0.09
 * @author RAFINA DANY <danyrafina@gmail.com>
 * @version 0.30
 * @php_version 7.00 RTM
 */

use GException\{LoadingError,EngineComparatorException,PDORNException,MaintenanceException};
use Compared\LayerConnector\MDA;
use Controller;

class Starter {

    public $isReady = 0;
    public $isMaintenance = 0;

    public function __construct()
    {
        $this->__autoloader();
        $this->initTwig();
        $this->isMaintenance();
        $this->verifyDatabase();
        $this->initApp();
        $this->isComparatorAvailable();
    }
    
    
    private function __autoloader() {
        include_once 'Autoloader.php';
    }
  
    public function isMaintenance() {
         $yamlFile = $this->getMasterFile();
         $isM = $yamlFile['MAINTENANCE'];
         if ($isM['MAINTENANCE_MODE'] == "ENABLED")
         {
             $this->isReady = 0 ;
             $this->isMaintenance = 1;
             throw new MaintenanceException("Désolé, COMPARED est en maintenance. Veuillez nous excuser.");
         }
         else {
             $this->isReady = 1;
             $this->isMaintenance = 0;
         }
    }

    public function isComparatorAvailable() {
        $yamlFile = $this->getMasterFile();
        $url = $yamlFile['ENGINE_COMPARATOR']['LINK_TO_ENGINE_COMPARATOR'];
        $data = array('Action' => 'ISAVAILABLE', 'key' => $yamlFile['ENGINE_COMPARATOR']['KEY'], 'appname' => $yamlFile["APP_NAME"]);
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
        else
        {
            $this->isReady = 0;
            throw new EngineComparatorException("Impossible de lier COMPARED au moteur de comparaison [ERROR " . $message->code . "]");
        }
    }

    public function isComparatorLink():bool
    {
        $yamlFile = $this->getMasterFile();
        $info = $yamlFile['ENGINE_COMPARATOR']['LINK'];
        return ($info === "NOTATTACHED")? false : true;
    }
    
    public function getMasterFile():array
    {
        try {
            return Spyc::YAMLLoad('PRIVATE/AppInfo.yml');
        } catch (Exception $ex) {
            throw new LoadingError('Erreur de chargement du module YAML');
        }
    }
    public function linkAppToComparator():string
    {
        $yamlFile = $this->getMasterFile();
        $url = $yamlFile['ENGINE_COMPARATOR']['LINK_TO_ENGINE_COMPARATOR'];
        $data = array('Action' => 'linkCToA', 'key' => $yamlFile['ENGINE_COMPARATOR']['KEY'], 'appname' => $yamlFile["APP_NAME"]);
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

    private function verifyDatabase()
    {
        try {
            $model = new MDA();
            $result = $model->checkAdministrator();
            unset($model);
            if ($result)
                $this->isReady = 1;
            else {
                new PDORNException("Une erreur a été généré par COMPARED : Vous ne pouvez pas utiliser l'application COMPARED sans administrateur");
                $this->isReady = 0;
            }
        }
        catch (Exception $ex)
        {
            new PDORNException('Une erreur a été généré par COMPARED : Erreur de base de donnée ', NULL, NULL);
            $this->isReady = 0;
        }
    }

    private function initApp()
    {
        if (file_exists('Pointer.php'))
            $this->isReady = 1;
        else
        {
            $this->isReady = 0;
            $loadingError = "Le routeur de l'application n'existe pas.";
            throw new LoadingError($loadingError);
        }
    }

    protected function initTwig()
    {
        try {
            include_once 'ENGINE_TEMPLATES/Twig/vendor/autoload.php';
            $_SESSION['twig'] = new Twig_Environment(new Twig_Loader_Filesystem('VIEWS'), array('cache' => false, 'debug' => true));
            $_SESSION['twig']->addExtension(new Twig_Extension_Debug());
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
