<?php

session_start();
$index = new IndexPhoneAdvisor();
$index->main($_REQUEST ?? NULL);
unset($index);

use PhoneAdvisor\Router\RoutePa;

class IndexPhoneAdvisor
{

    protected $request;
    /** The App main
     * @param null $request
     * @throws \GException\RuntimeError
     */
    public function main($request = null)
    {
        $this->request = ($request != null) ? $request : null;
        require_once 'StarterPa.php';
        $starter = new StarterPa();
        ($starter->isReady == 1) ? $this->startApp() : NULL;
        unset($starter);
    }

    /** To start app
     * @throws \GException\RuntimeError
     */
    public function startApp()
    {
        (isset($this->request['run'])) ? $this->checker() : new GException\RuntimeError("Runnable doesn't exist!");
    }

    /** Check arguments
     * @throws \GException\RuntimeError
     */
    private function checker()
    {
        /*if (isset($this->request['run']) && isset($this->request['argument']) && empty($this->request['run']) && $this->request['argument'] == 'void')
            Pointer::runnable("getHomePage", array($this->request));
        else if (isset($this->request['argument']))
            Pointer::runnable($this->request['run'], array($this->request['argument']));
        else if ((isset($this->request['id']) && isset($this->request['password'])) ||
            (isset($this->request['sm1']) && isset($this->request['sm2'])) ||
            (isset($this->request['name']) && isset($this->request['email']) && isset($this->request['subject']) && isset($this->request['content'])) ||
            (isset($this->request['pin'])) ||
            (isset($this->request['pin']) && isset($this->request['mod'])) ||
            (isset($this->request['name']) && isset($this->request['version']) && isset($this->request['slogan']) && isset($this->request['link']) && isset($this->request['KEY'])) ||
            (isset($this->request['score']) && isset($this->request['sm'])))*/

        RoutePa::runnable($this->request['run'], array($this->request));
       // else
         //   throw new GException\RuntimeError("Cette page n'existe pas");
    }

}