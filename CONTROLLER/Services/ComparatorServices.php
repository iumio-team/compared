<?php
/**
 * Created by PhpStorm.
 * User: rafina
 * Date: 02/02/16
 * Time: 09:09
 */

namespace Compared\Services;
use Compared\Abs\Services\AbstractSender;
use GException\EngineComparatorException;

class ComparatorServices extends AbstractSender
{

    private $url;
    private $appName;
    private $key;
    private $status;

    public function __construct()
    {
        $info = $this->get_master_file();
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
        else {
            if (isset($response->code))
                throw new EngineComparatorException("Impossible de lier COMPARED au moteur de comparaison [ERROR " . $response->code . "]");
            else
                throw new EngineComparatorException("Le moteur de comparaison ne répond pas");
        }
    }

    public function linkAppToComparator():array
    {
        $data = array('Action' => 'linkCToA', 'key' => $this->key, 'appname' => $this->appName);
        $res = $this->to_send($this->url, $data);
        if (is_array($res) && isset($res[0]) && $res[0] == 'ISAVAILABLE')
            return array("status"=>"AVAILABLE");
        else
            return array("status"=>"ERROR", "message"=>$res);
    }

    public function is_linked():bool
    {
        return ($this->status === "NOTATTACHED")? false : true;
    }

    public function start($result_mod = null)
    {
        $r = $this->is_available();
        if ($r == 1)
        {
            $r = $this->is_linked();
            if ($r)
            {
                if ($result_mod == "program")
                    return 1;
                else
                    echo 1;
            }
            else
                throw new EngineComparatorException("Le moteur de comparaison n'est pas disponible");
        }

    }
}