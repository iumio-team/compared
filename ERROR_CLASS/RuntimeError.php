<?php

namespace GException;
use Exception;
error_reporting(0);
class RuntimeError extends Exception {

	static private $errorMessage;

	public function __construct($errorMessage) {
            parent::__construct($errorMessage, 901, $previous=NULL);
		self::$errorMessage = $errorMessage; 
		echo  $_SESSION['twig']->render('viewError.html.twig',array('error' => $errorMessage,'type'=>'runtime'));

	}

	

	static public function getErrorMessage(){

		return self::$errorMessage;

	}

	

	static public function setErrorMessage(string $newErrorMessage){

		self::$errorMessage = $newErrorMessage;

	}

	

}