<?php
/**
 * Created by PhpStorm.
 * User: rafina
 * Date: 02/02/16
 * Time: 09:19
 */

namespace Compared\Abs\Supervisor;
use Compared\LayerConnector\MDA;


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

}