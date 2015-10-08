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
use LayerConnector\MDA;

class Constructor implements Omium{
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
        $count = MDA::insertConstructor($this->name, $this->description)->rowCount();
        return $count;
        
    }
    
    public function delete() {
        parent::delete();
        $count = MDA::deleteAllById('Constructor', $this->name,'name')->rowCount();
         return $count;
    }
    public function update() {
        parent::update();
        $count = MDA::updateConstructor($this->name, $this->description)->rowCount();
        return $count;
    }

    public function getItem(){
           $item = MDA::findAllById('Constructor', $this->name, 'name')->fetch();
           $this->description = $item['description'];
           
    }
    
}
