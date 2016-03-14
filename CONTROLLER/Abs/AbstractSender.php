<?php
/**
 * Created by PhpStorm.
 * User: rafina
 * Date: 02/02/16
 * Time: 09:12
 */

namespace Compared\Abs\Services;
use Compared\Interfaces\Services\Autonomus;
use Spyc;

class AbstractSender extends Services implements  Autonomus
{
    protected $service_status = "enabled";
    protected $timer;

    protected function getMasterFile():array
    {
        try {
            return Spyc::YAMLLoad('PRIVATE/AppInfo.yml');
        } catch (Exception $ex) {
            throw new LoadingError('Erreur de chargement du module YAML');
        }
    }

    public function disable():bool
    {
        $this->service_status = "disabled";
        return true;
    }

    protected function thread()
    {
        // TODO: Implement thread() method.
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

    protected function to_send(string $url, array $data)
    {
        $ch = curl_init($url);
        $post = http_build_query($data, '', '&');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $this->response = json_decode($response);
    }

    protected function get_response()
    {
        return $this->response;
    }
}