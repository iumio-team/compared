<?php
/**
 * Created by PhpStorm.
 * User: rafina
 * Date: 02/06/16
 * Time: 10:43
 */

namespace Compared\Services;
use GException\LoadingError;
use Spyc;


class YamlServices
{
    private $fileLocation;
    private $content = null;

    public function __construct(String $fileLocation)
    {
        $this->fileLocation = $fileLocation;
    }

    public function get_file_content():int
    {
        try {
           $this->content =  Spyc::YAMLLoad($this->fileLocation);
            return 1;
        } catch (Exception $ex) {
            return 0;
            throw new LoadingError('Erreur de chargement du fichier demandé');
        }
    }

    /**
     * @return String
     */
    public function getFileLocation():string
    {
        return $this->fileLocation;
    }

    /**
     * @param String $fileLocation
     */
    public function setFileLocation(String $fileLocation)
    {
        $this->fileLocation = $fileLocation;
    }

    /**
     * @return null
     */
    public function getContent():array
    {
        return $this->content;
    }

    /**
     * @param null $content
     */
    public function setContent(array $content)
    {
        $this->content = $content;
    }


    public function dump_content(array $content):int
    {
        //TO DO
    }

    public function start():int
    {
        return ($this->get_file_content());
    }
}

