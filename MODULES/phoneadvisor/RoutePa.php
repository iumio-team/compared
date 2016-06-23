<?php

/** This is the pointer which enables to redirect 
 * @author  RAFINA DANY <danyrafina@gmail.com>
 * 
 */

namespace PhoneAdvisor\Router;
use GException\{RuntimeError, LoadingError};
use PhoneAdvisor\Controller\ControllerPa;

class RoutePa {

    public static function runnable(String $run, array $arg) {
        if ($run == "Service")
            self::__callService($arg);
        else
            echo self::__callController($run, $arg);
    }

    static private function __callController(String $run, array $arg = null)
    {
        $controller = new ControllerPa();
        switch ($run) {
            case 'start':
                $controller->startAdvise();
                break;
            case 'question' :
               $controller->question($arg[0]['number']);
                break;
            default :
                throw new RuntimeError("Erreur d'exécution de l'instruction demandé");
        }
        unset($controller);
    }

}
