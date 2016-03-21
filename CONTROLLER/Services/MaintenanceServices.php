<?php
/**
 * Created by PhpStorm.
 * User: rafina
 * Date: 02/02/16
 * Time: 09:09
 */

namespace Compared\Services;
use Compared\Abs\Services\AbstractMaintenance;
use GException\MaintenanceException;

class MaintenanceServices extends AbstractMaintenance
{

    private $mode;
    private $message;
    private $timestamp;

    public function __construct()
    {
        $info = $this->getMasterFile();
        $this->mode = $info['MAINTENANCE']['MAINTENANCE_MOD'];
    }

    protected function is_maintenance():int
    {
        if ($this->mode == "ENABLED")
        {
            throw new MaintenanceException("Désolé, COMPARED est en maintenance. Veuillez nous excuser.");
            return 1;
        }
        else
           return 0;
    }

    public function setMaintenance(String $mod, String $message):int
    {
        $mod = strtoupper($mod);
        if ($mod == "ENABLED" || "DISABLED")
        {
            $r = $this->editMasterFile($mod, $message, time());
            return $r;
        }
        else
            return 0;

    }

    public function getMessage():string
    {
        return $this->message;
    }

    public function getMode():string
    {
        return $this->mode;
    }

    public function getTimestamp():int
    {
        return $this->timestamp;
    }

    public function setMessage(String $message)
    {
        $this->message = $message;
    }

    public function setMode(String $mode)
    {
        $this->mode = $mode;
    }

    public function setTimestamp(int $timestamp)
    {
        $this->timestamp = $timestamp;
    }
    public function start(String $result_mod = null)
    {
        $r = $this->is_maintenance();
        if ($result_mod == "ajax")
          echo $r;
        else
            return $r;
    }
}