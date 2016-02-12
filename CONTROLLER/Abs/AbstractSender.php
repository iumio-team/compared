<?php
/**
 * Created by PhpStorm.
 * User: rafina
 * Date: 02/02/16
 * Time: 09:12
 */

namespace Compared\Abs\Services;
use Compared\Interfaces\Services\Autonomus;
use Compared\Interfaces\Services\Services;
use Spyc;

class AbstractSender implements  Autonomus, Services
{
    protected function getMasterFile():array
    {
        try {
            return Spyc::YAMLLoad('PRIVATE/AppInfo.yml');
        } catch (Exception $ex) {
            throw new LoadingError('Erreur de chargement du module YAML');
        }
    }

    public function disable()
    {
        // TODO: Implement disable() method.
    }

    public function enable()
    {
        // TODO: Implement enable() method.
    }

    public function setTimer()
    {
        // TODO: Implement setTimer() method.
    }

    public function to_send()
    {
        // TODO: Implement to_send() method.
    }

    public function get_response()
    {
        // TODO: Implement get_response() method.
    }


}