<?php
/**
 * Created by PhpStorm.
 * User: rafina
 * Date: 02/06/16
 * Time: 13:53
 */

namespace PhoneAdvisor\Controller;
use Compared\Abs\Supervisor\AbstractController;

class ControllerPa extends  AbstractController
{
    public function startAdvise()
    {
        echo $_SESSION['twig']->render('phoneadvisor/viewPhoneAdvisor.html.twig');
    }

    public function question($num)
    {
        if ($num == 1)
        {
            $quest = "Vous êtes ?";
            $resp = array("un homme", "une femme");
            $resType = "radio";
            echo json_encode(array("question" => $quest, "response" => $resp, "responseType" => $resType));
        }
    }

    public function response($num)
    {

    }
}