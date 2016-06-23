<?php
/**
 * Created by PhpStorm.
 * User: rafina
 * Date: 02/02/16
 * Time: 09:12
 */

namespace Compared\Abs\Services;
use Compared\Interfaces\Services\Autonomus;
use MongoDB\BSON\Timestamp;
use Compared\Tools\UtilityFunction as UF;
use Spyc;

class AbstractMaintenance implements  Autonomus
{
    private $service_status = "enabled";

    protected function getMasterFile():array
    {
        try {
            return Spyc::YAMLLoad(UF::getRootProject().'/PRIVATE/AppInfo.yml');
        } catch (Exception $ex) {
            throw new LoadingError('Erreur de chargement du module YAML');
        }
    }

    protected function editMasterFile(String $mod, String $message, int $timestamp):int
    {
        Spyc::YAMLDump(array("MAINTENANCE"=>array("MAINTENANCE_MOD"=>$mod, "MAINTENANCE_MESSAGE"=>$message, "MAINTENANCE_TIMESTAMP"=>$timestamp)));
        return 1;
    }

    public function disable():bool
    {
        $this->service_status = "disabled";
        return true;
    }

    public function enable():bool
    {
        $this->service_status = "enabled";
        return true;
    }

    public function setTimer(int $sequence):bool
    {
       $this->timer = $sequence;
        return true;
    }

}