<?php

namespace ORM_Entity;

use OmiumORM\Omium as ORM;
use Compared\LayerConnector\MDA as Model;

class Os implements ORM {

    private $id, $name, $version, $constructor, $releaseDate;

    public function __construct($arg) {
        switch($arg){
            case is_array($arg):
                $this->id = $arg['id'];
                $this->name = $arg['name'];
                $this->version = $arg['version'];
                $this->constructor = $arg['constructor'];
                $this->releaseDate = $arg['releaseDate'];
                break;
            default:
                $this->id = $arg;
        }

    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getVersion() {
        return $this->version;
    }

    public function getConstructor() {
        return $this->constructor;
    }

    public function getReleaseDate() {
        return $this->releaseDate;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setVersion($version) {
        $this->version = $version;
    }

    public function setConstructor($constructor) {
        $this->constructor = $constructor;
    }

    public function setReleaseDate($releaseDate) {
        $this->releaseDate = $releaseDate;
    }

    public function create() {
        parent::create();
        $count = (new Model())->insertOS($this->name,$this->version,$this->constructor,$this->releaseDate)->rowCount();
        return $count;
    }

    public function delete() {
        parent::delete();
        $count = (new Model())->deleteAllById('OS', $this->id, 'idOS')->rowCount();
        return $count;
    }

    public function update() {
        parent::update();
        $count = (new Model())->updateCompared($this->id, $this->name, $this->releaseDate, $this->version)->rowCount();
        return $count;
    }
    public function getItem(){
        $result = (new Model())->findAllById('OS',$this->id,'idOS')->fetch();
        $this->name = $result['nameOS'];
        $this->version = $result['versionOS'];
        $this->constructor = $result['constructorOS'];
        $this->releaseDate = $result['releaseDateOS'];

    }
}
