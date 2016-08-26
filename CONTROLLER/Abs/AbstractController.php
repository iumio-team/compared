<?php
/**
 * Created by PhpStorm.
 * User: rafina
 * Date: 02/02/16
 * Time: 09:19
 */

namespace Compared\Abs\Supervisor;
use Compared\LayerConnector\MDA;
use Compared\Services\YamlServices;


class AbstractController
{
    protected $model_instance = NULL;

    /** This is a Singleton
     * Get an instance of model
     * @return Model Instance of Model Class
     */
    protected function getModel():MDA
    {
        return ($this->modal_instance == NULL)? $this->model_instance = new MDA(): $this->model_instance;
    }


    /** This file contains essential COMPARED informations
     * @return array Informations
     */
    protected function getMasterFile():array
    {
        $service = new YamlServices('PRIVATE/AppInfo.yml');
        $e = $service->start();
        if ($e == 1)
            return $service->getContent();
        else
            return array();
    }

    /**
     * Load some modules
     * @return array Modules elements
     */

    protected function loadModules():array
    {
        $arrm = array();
        $ms = $this->getMasterFile();
        $modules = $ms['MODULES'];
        if (count($modules) > 0) {

            foreach ($modules as $one) {
                $module_location = $one['MODULE_LOCATION'] . '/app.yml';
                $service = new YamlServices($module_location);
                $service->start();
                $info = $service->getContent()['IUM_MODULE'];
                array_push($arrm, array('name' => $info['DISPLAY_NAME'], 'small_desc' => $info['SMALL_DESCRIPTION_FR'], 'location' => $one['MODULE_NAME'], "menu" => $info['SHOW_IN_MENU']));
                return ($arrm);
            }
        }
        else
            return array();

    }


    /** Load essential component to run COMPARED
     * @return array Essential components
     */
    protected function loadEssentialComponents(): array
    {
        $model = $this->getModel();
        $nbS = $model->countLine('Smartphone', 'idS')->fetch()['count'];
        $modules = $this->loadModules();
        return (array("modules" => $modules, "sm_number" => $nbS));
    }


}