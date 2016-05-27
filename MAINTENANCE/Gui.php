<?php

/**
 * Welcome on COMPARED Gui ( Web User Interface) FILE 
 * This file is the same as index.php but it's designed for COMPARED WEB APP 
 */
session_start();
if (isset($_REQUEST)) {
    $request = $_REQUEST;
}

Gui::main($request);

/** Class Gui
 * @author RAFINA DANY <danyrafina@gmail.com>
 * @since 0.12 ALPHA
 * @version 0.16 ALPHA
 */

class Gui {

    static private $request = null;
    static private $run = null;

    static public function main($request = null) {


        if ($request != null) {
            Gui::$request = $request;
        }
        require_once 'M_Starter.php';
        M_Starter::switchOnApp();
        if (M_Starter::$isReady == 1) {
            Gui::startApp();
        }
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
        } else if (isset(Gui::$request['run']) && isset(Gui::$request['pin'])) {
            Gui::$run = Gui::$request['run'];
            Router::runnable(Gui::$run, Gui::$request);
        } else if (isset(Gui::$request['run']) && isset(Gui::$request['pin']) && isset(Gui::$request['mod'])) {
            Gui::$run = Gui::$request['run'];
            Router::runnable(Gui::$run, Gui::$request);
        } else if (isset(Gui::$request['run']) && isset(Gui::$request['name']) && isset(Gui::$request['version']) && isset(Gui::$request['slogan']) && isset(Gui::$request['link']) && isset(Gui::$request['token'])) {
            Gui::$run = Gui::$request['run'];
            Router::runnable(Gui::$run, Gui::$request);
        } else {
            Router::runnable('getLoginView', "Mode maintenance");
        }
    }

}
