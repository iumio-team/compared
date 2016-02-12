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
    private $token;
    private $appName;
    private $key;

    public function __construct()
    {
        $info = $this->getMasterFile();
        $this->url = $info['ENGINE_COMPARATOR']['LINK_TO_ENGINE_COMPARATOR'];
        $this->appName = $info["APP_NAME"];
        $this->key = $info['ENGINE_COMPARATOR']['KEY'];
    }
/*$yamlFile = $this->getMasterFile();
$url = $yamlFile['ENGINE_COMPARATOR']['LINK_TO_ENGINE_COMPARATOR'];
$data = array('Action' => 'ISAVAILABLE', 'key' => $yamlFile['ENGINE_COMPARATOR']['Token'], 'ORM' => , 'appname' => $yamlFile["APP_NAME"]);
$ch = curl_init($url);
$post = http_build_query($data, '', '&');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$message = json_decode($response);
if (is_array($message) && isset($message[0]) && $message[0] == 'ISAVAILABLE' )
$this->isReady = 1;
else if ($this->isComparatorLink() == false)
$this->isReady = 1;
else
{
$this->isReady = 0;
throw new EngineComparatorException("Impossible de lier COMPARED au moteur de comparaison [ERROR " . $message->code . "]");
}*/
}