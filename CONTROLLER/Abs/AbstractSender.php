<?php
/**
 * Created by PhpStorm.
 * User: rafina
 * Date: 02/02/16
 * Time: 09:12
 */

namespace Compared\Abs\Services;
use Spyc;

class AbstractSender
{
    protected function getMasterFile():array
    {
        try {
            return Spyc::YAMLLoad('PRIVATE/AppInfo.yml');
        } catch (Exception $ex) {
            throw new LoadingError('Erreur de chargement du module YAML');
        }
    }
}