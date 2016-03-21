<?php
/**
 * Created by PhpStorm.
 * User: rafina
 * Date: 02/02/16
 * Time: 09:09
 */

namespace Compared\Services;
use Compared\LayerConnector\MDA;

class DatabaseServices
{
    private function verifyDatabase():int
    {
        try {
            $model = new MDA();
            $result = $model->checkAdministrator();
            unset($model);
            if ($result)
                return 1;
            else {
                new PDORNException("Une erreur a été généré par COMPARED : Vous ne pouvez pas utiliser l'application COMPARED sans administrateur");
                return 0;
            }
        }
        catch (Exception $ex)
        {
            new PDORNException('Une erreur a été généré par COMPARED : Erreur de base de donnée ', NULL, NULL);
           return 0;
        }
    }


    public function start():int
    {
        return ($this->verifyDatabase());
    }
}