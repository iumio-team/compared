<?php
/**
 * Created by PhpStorm.
 * User: rafina
 * Date: 02/02/16
 * Time: 09:52
 */

namespace Compared\Abs\Services;

abstract class ServicesSR
{
    protected $response = NULL;

    protected abstract function to_send(string $url, array $data);
    protected abstract function get_response();
    protected abstract function thread();

}