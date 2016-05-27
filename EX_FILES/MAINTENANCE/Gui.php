<?php

/**
 * Welcome on COMPARED Gui ( Web User Interface) FILE 
 * This file is the same as index.php but it's designed for COMPARED WEB APP 
 * This file was created on the 10th of October in 2014
 */
session_start();
if (isset($_REQUEST)) {
    $request = $_REQUEST;
}

Gui::main($request);

/** Class Gui
 * @author RAFINA DANY <danyrafina@gmail.com>
 * @since 0.12
 * @version 0.12
 */
class Gui {

    static private $request = null;
    static private $run = null;

    static public function main($request = null) {


        if ($request != null) {
            Gui::$request = $request;
        }
        require_once 'StarterMaintenance.php';
        StarterMaintenance::switchOnApp();
        
            Gui::startApp();
        
    }

    static public function startApp() {
        if (isset(Gui::$request['run']) && isset(Gui::$request['argument'])) {
            Gui::$run = Gui::$request['run'];
            $arg = Gui::$request['argument'];
            Router::runnable(Gui::$run, array($arg));
        } else if (isset(Gui::$request['run']) && isset(Gui::$request['id']) && isset(Gui::$request['password'])) {
            Gui::$run = Gui::$request['run'];
            Router::runnable(Gui::$run, Gui::$request);
        } else if (isset(Gui::$request['run']) && isset(Gui::$request['sm1']) && isset(Gui::$request['sm2'])) {
            Gui::$run = Gui::$request['run'];
            Router::runnable(Gui::$run, Gui::$request);
        } else if (isset(Gui::$request['run']) && isset(Gui::$request['name']) && isset(Gui::$request['email']) && isset(Gui::$request['object']) && isset(Gui::$request['content'])) {
            Gui::$run = Gui::$request['run'];
            Router::runnable(Gui::$run, Gui::$request);
        } else if (isset(Gui::$request['run']) && isset(Gui::$request['pin'])) {
            Gui::$run = Gui::$request['run'];
            Router::runnable(Gui::$run, Gui::$request);
       
    }
    else{
        Router::runnable('getLoginView',"Mode maintenance");
    }
        }

}
