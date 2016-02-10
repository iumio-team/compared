<?php
/**
 * Created by PhpStorm.
 * User: rafina
 * Date: 17/01/16
 * Time: 15:07
 */

namespace GException;
use Exception;

abstract class AbstractException extends Exception
{

    protected $errorMessage;

    public function __construct(string $error, string $type) {
        parent::__construct($error, '800', NULL);
        $this->errorMessage = $error;
        echo  $_SESSION['twig']->render('viewError.html.twig', array('error'=>$error, 'type'=> $type));
    }

    public function getErrorMessage():string
    {
        return self::$errorMessage;
    }

    public function setErrorMessage(string $newErrorMessage)
    {
        $this->errorMessage = $newErrorMessage;
    }
}