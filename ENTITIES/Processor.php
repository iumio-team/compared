<?php

use LayerConnector\MDA;

class Processor implements Omium {

    private $idP;
    private $nameP;
    private $constructorP;
    private $nbOfCoreP;
    private $frequencyP;
    private $archP;
    private $versionP;

    public function __construct($arg) {
        switch($arg) {
            case is_array($arg):

                $this->idP  = $arg['id'];
                $this->nameP = $arg['name'];
                $this->constructorP = $arg['constructor'];
                $this->nbOfCoreP = $arg['nbOfCore'];
                $this->frequencyP = $arg['frequency'];
                $this->archP = $arg['arch'];
                $this->versionP = $arg['version'];

                break;
            default:
                $this->idP = $arg;
                break;
        }

    }

    public function getIdP() {

        return $this->idP;
    }

    public function setIdP($idP) {

        $this->idP = $idP;
    }

    public function getNameP() {

        return $this->nameP;
    }

    public function setNameP($nameP) {

        $this->nameP = $nameP;
    }

    public function getConstructorP() {

        return $this->constructorP;
    }

    public function setConstructorP($constructorP) {

        $this->constructorP = $constructorP;
    }

    public function getNbOfCoreP() {

        return $this->nbOfCoreP;
    }

    public function setNbOfCoreP($nbOfCoreP) {

        $this->nbOfCoreP = $nbOfCoreP;
    }

    public function getFrequencyP() {

        return $this->frequencyP;
    }

    public function setFrequencyP($frequencyP) {

        $this->frequencyP = $frequencyP;
    }

    public function getArchP() {

        return $this->archP;
    }

    public function setArchP($archP) {

        $this->archP = $archP;
    }

    public function getVersionP() {

        return $this->versionP;
    }

    public function setVersionP($versionP) {

        $this->versionP = $versionP;
    }

   public function create() {
        parent::create();
        $count = MDA::insertProcessor($this->idP,$this->namingP,$this->constructorP,$this->nbOfCoreP,$this->frenquencyP,$this->archP,$this->versionP)->rowCount();
        return $count;
    }

    public function delete() {
        parent::delete();
        $count = MDA::deleteAllById('Processor', $this->idP, 'idP')->rowCount();
        return $count;
    }

    public function update() {
        parent::update();
        $count = MDA::updateProcessor($this->idP,$this->namingP,$this->nbOfCoreP,$this->frenquencyP,$this->archP,$this->versionP)->rowCount();
        return $count;
    }

    public function getItem(){
        $result = MDA::findAllById('Processor',$this->idP,'idProc')->fetch();
        $this->nameP = $result['nameProc'];
        $this->versionP = $result['versionProc'];
        $this->constructorP = $result['constructorProc'];
        $this->nbOfCoreP = $result['nbCoreProc'];
        $this->archP = $result['archProc'];
        $this->frequencyP = $result['frequencyProc'];
    }

}
