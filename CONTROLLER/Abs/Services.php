<?php
/**
 * Created by PhpStorm.
 * User: rafina
 * Date: 02/02/16
 * Time: 09:52
 */

namespace Compared\Abs\Services;

abstract class Services
{
    protected $response = NULL;

    protected abstract function to_send(string $url, array $data):void;
    protected abstract function get_response();
    protected abstract function thread();

}