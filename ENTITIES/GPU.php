<?php

use LayerConnector\MDA;

class GPU  implements Omium{

    private $id , $name,$constructor,$version ,$frequency, $gflops ,$print , $directXV ;

    public function __construct($arg){
        switch($arg){
            case is_array($arg):
                $this->id = $arg['id'];
                $this->name = $arg['name'];
                $this->constructor = $arg['constructor'];
                $this->version= $arg['version'];
                $this->frequency = $arg['frequency'];
                $this->gflops = $arg['gflops'];
                $this->print = $arg['print'];
                $this->directXV = $arg['directXV'];
                break;
            default:
                $this->id = $arg;
        }
    }
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getConstructor()
    {
        return $this->constructor;
    }

    /**
     * @param mixed $constructor
     */
    public function setConstructor($constructor)
    {
        $this->constructor = $constructor;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return mixed
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * @param mixed $frequency
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;
    }

    /**
     * @return mixed
     */
    public function getGflops()
    {
        return $this->gflops;
    }

    /**
     * @param mixed $gflops
     */
    public function setGflops($gflops)
    {
        $this->gflops = $gflops;
    }

    /**
     * @return mixed
     */
    public function getPrint()
    {
        return $this->print;
    }

    /**
     * @param mixed $print
     */
    public function setPrint($print)
    {
        $this->print = $print;
    }

    /**
     * @return mixed
     */
    public function getDirectXV()
    {
        return $this->directXV;
    }

    /**
     * @param mixed $directXV
     */
    public function setDirectXV($directXV)
    {
        $this->directXV = $directXV;
    }

    public function update() {
    }

    /** delete comparison on database
     *
     */
    public function delete() {
    }

    /** Create a new comparison
     *
     */
    public function create() {
    }

    /** Search an item by id
     */
    public function getItem(){
        $result = MDA::findAllById('GPU',$this->id ,'idG')->fetch();
        $this->name = $result['nameG'];
        $this->version = $result['versionG'];
        $this->constructor = $result['constructorG'];
        $this->directXV = $result['directXV'];
        $this->gflops = $result['gflops'];
        $this->frequency = $result['frequency'];
        $this->print = $result['print'];
    }
}