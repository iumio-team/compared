<?php

namespace GException;
use Exception;
error_reporting(0);
class EngineComparatorException extends Exception {

	static private $errorMessage;

	

	public function __construct($loadingError) {
                parent::__construct($loadingError, '800', NULL);
		self::$errorMessage = $loadingError;
		echo  $_SESSION['twig']->render('viewError.html.twig',array('error' => $loadingError,'type'=>'engine comparator'));

	

	}

	static public function getErrorMessage(){

		return self::$errorMessage;

	}

	

	static public function setErrorMessage($newErrorMessage){

		self::$errorMessage = $newErrorMessage;

	}

	

}