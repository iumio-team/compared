<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Constructor
 *
 * @author rafina
 */

namespace ORM_Entity;

use OmiumORM\Omium as ORM;
use Compared\LayerConnector\MDA as Model;

class Constructor implements ORM {
    private  $name ; 
    private  $description;
    
    public function __construct($name,$description=NULL) {
        $this->name = $name;
        if($description != NULL)
            $this->description = $description;
    }
    
    public function getName():String {
        return $this->name;
        
    }
    public function setName(String $name) {
        $this->name = $name;

    }
    
     public function getDescription():String {
        return $this->description;
        
    }
    public function setDescription(String $description) {
        $this->description = $description;

    }
    
    public function create() {
        parent::create();
        $count = (new Model())->insertConstructor($this->name, $this->description)->rowCount();
        return $count;
        
    }
    
    public function delete() {
        parent::delete();
        $count = (new Model())->deleteAllById('Constructor', $this->name,'name')->rowCount();
         return $count;
    }
    public function update() {
        parent::update();
        $count = (new Model())->updateConstructor($this->name, $this->description)->rowCount();
        return $count;
    }

    public function getItem(){
           $item = (new Model())->findAllById('Constructor', $this->name, 'name')->fetch();
           $this->description = $item['description'];
           
    }
    
}
