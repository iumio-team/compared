<?php

namespace GException;
use Exception;

/**
 * This is a could to DATABASE EXCEPTIONS
 * @author RAFINA
 */

class PDORNException extends Exception{
	
	static private $errorMessage;
	public function _construct($errorMessage) {
            
            try {
                parent::__construct;
		self::$errorMessage = $errorMessage;
		
		echo  $_SESSION['twig']->render('viewError.html.twig',array('error' => $errorMessage));
                
            } catch (PDOException $exc) {
                echo $exc->getTraceAsString();
            }

            
	}
	
	static public function getErrorMessage() {
		return self::$errorMessage;
	}
	
	static public function setErrorMessage(string $newErrorMessage){
		self::$errorMessage = $newErrorMessage;
	}
	
}