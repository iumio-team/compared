<?php
/**
 * Created by PhpStorm.
 * User: rafina
 * Date: 02/02/16
 * Time: 09:09
 */

namespace Compared\Services;
use GException\RequestError;
use GException\RuntimeError;

class ErrorServices
{

    private $type;


    public function __construct($type)
    {
        error_log($type."ferferfefref");
        $this->type = $type;
    }

    public function displayError():int
    {
        switch ($this->type)
        {
            case '404' :
                new RequestError("404", "Oups! La page n'existe pas.");
                break;
            case '500' :
                new RequestError("500", "COMPARED a rencontré une erreur fatale, Veuillez nous en excusez");
                break;
            case '503' :
                new RequestError("503", "COMPARED n'est pas disponible pour le moment. Veuillez réesayer.");
                break;
            case '401' :
                new RequestError("401", "Echec de l'authentification");
                break;
            default:
                return (-1);
        }
        return (1);
    }

    public function start($result_mod = null)
    {
       $res = $this->displayError();
        if ($res != 1)
            throw new RuntimeError("Une erreur FATALE s'est produite, Veuillez contactez l'administrateur");

    }
}