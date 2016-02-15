<?php
/**
 * Created by PhpStorm.
 * User: rafina
 * Date: 02/02/16
 * Time: 09:09
 */

namespace Compared\Services;
use Compared\Abs\Services\AbstractSender;


class ComparatorServices extends AbstractSender
{

    private $url;
    private $appName;
    private $key;
    private $status;

    public function __construct()
    {
        $info = $this->getMasterFile();
        $this->url = $info['ENGINE_COMPARATOR']['LINK_TO_ENGINE_COMPARATOR'];
        $this->appName = $info["APP_NAME"];
        $this->key = $info['ENGINE_COMPARATOR']['KEY'];
        $this->status = $info['ENGINE_COMPARATOR']['LINK'];
    }

    public function is_available():int
    {
        $data = array('Action' => 'ISAVAILABLE', 'key' => $this->key , 'appname' => $this->appName);
        $this->to_send($this->url, $data);
        $response = $this->get_response();
        if (is_array($response) && isset($response[0]) && $response[0] == 'ISAVAILABLE' )
           return 1;
        else
            throw new EngineComparatorException("Impossible de lier COMPARED au moteur de comparaison [ERROR " . $response->code . "]");
    }

    public function is_linked():bool
    {
        return ($this->status === "NOTATTACHED")? false : true;
    }
}