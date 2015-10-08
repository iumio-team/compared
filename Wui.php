<?php

/**
 * Welcome on COMPARED WUI ( Web User Interface) FILE 
 * This file is the same as index.php but it's designed for COMPARED WEB APP 
 * This file was created on the 10th of October in 2014
 */
session_start();
if (isset($_REQUEST)) {
    $request = $_REQUEST;
}

Wui::main($request);

/** Class Wui
 * @author RAFINA DANY <danyrafina@gmail.com>
 * @since 0.02 PROTOTYPE
 * @version 0.30 BETA
 */
class Wui {

    static private $request = null;
    static private $run = null;

    static public function main($request = null) {;
        
        if ($request != null) {
            Wui::$request = $request;
        }
        require_once 'Starter.php';
        Starter::switchOnApp();
        if (Starter::$isReady == 1) {
            Wui::startApp();
        }
       
    }

    static public function startApp() {
        if (isset(Wui::$request['run']) && isset(Wui::$request['argument'])) {
            Wui::$run = Wui::$request['run'];
            $arg = Wui::$request['argument'];
            Pointer::runnable(Wui::$run, array($arg));
        } else if (isset(Wui::$request['run']) && isset(Wui::$request['id']) && isset(Wui::$request['password'])) {
            Wui::$run = Wui::$request['run'];
            Pointer::runnable(Wui::$run, Wui::$request);
        } else if (isset(Wui::$request['run']) && isset(Wui::$request['sm1']) && isset(Wui::$request['sm2'])) {
            Wui::$run = Wui::$request['run'];
            Pointer::runnable(Wui::$run, Wui::$request);
        } else if (isset(Wui::$request['run']) && isset(Wui::$request['name']) && isset(Wui::$request['email']) && isset(Wui::$request['subject']) && isset(Wui::$request['content'])) {
            Wui::$run = Wui::$request['run'];
            Pointer::runnable(Wui::$run, Wui::$request);
        } else if (isset(Wui::$request['run']) && isset(Wui::$request['pin'])) {
            Wui::$run = Wui::$request['run'];
            Pointer::runnable(Wui::$run, Wui::$request);
        } 
        else if (isset(Wui::$request['run']) && isset(Wui::$request['pin'])&& isset(Wui::$request['mod'])) {
            Wui::$run = Wui::$request['run'];
            Pointer::runnable(Wui::$run, Wui::$request);
            
        } else if (isset(Wui::$request['run']) && isset(Wui::$request['name']) && isset(Wui::$request['version']) && isset(Wui::$request['slogan']) && isset(Wui::$request['link']) && isset(Wui::$request['token'])) {
            Wui::$run = Wui::$request['run'];
            Pointer::runnable(Wui::$run, Wui::$request);
        } else {
            Pointer::runnable('getHomePage',NULL);
        }
    }

}
