<?php

namespace GException;
use Exception;
error_reporting(0);
class MaintenanceException extends Exception {

    protected $message;

    public function __construct($message) {
        if( $_REQUEST['run'] == "getLoginView" && $_REQUEST['argument'] == "void"){
            header("Location:http://".$_SERVER['SERVER_ADDR']."/COMPARED/MAINTENANCE/Gui.php");
        }
        else {
		echo  $_SESSION['twig']->render('viewError.html.twig',array('error' => $message));

        }	
    }
}