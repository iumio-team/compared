<?php
/**
 * Created by PhpStorm.
 * User: rafina
 * Date: 02/02/16
 * Time: 09:13
 */

namespace Compared\Interfaces\Services;

interface Autonomus
{
    public function disable():bool;
    public function enable():bool ;
    public function setTimer(int $sequence):bool;

}