<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use LayerConnector\MDA;
/**
 * Description of SScore
 *
 * @author dany
 */
class SScore extends Score implements Omium {
    private $idS;
    
    public function __construct(int $idSScore, float $scoreValue,DateTime $creationDateTime) {
        if($scoreValue !== NULL && $creationDateTime !== NULL)
        {
            parent::__construct($idSScore,$scoreValue,$creationDateTime);
            
        }
        else 
        {
           parent::__construct($idSScore); 
        }
        
    }
    
    /*static protected function toTableName():String {
        $tb = strtoupper(get_class($this));
        $firstLetter = $tb[0];
        $tb[0] = $tb[0]."_";
        return $tb;
    }*/


    public function create() {
        parent::create();
        $count = MDA::insertScore(parent::$idScore,parent::$scoreValue,parent::$creationDateTime,array('idSS',  $this->idS->getIdSm()))->rowCount();
        return $count;
    }

    public function delete() {
        parent::delete();
        $count = MDA::deleteAllById("S_SCORE", parent::$idScore,'idSS')->rowCount();
        return $count;
        
    }

    public function getItem() {
         $item = MDA::findAllById('S_SCORE', parent::$idScore, 'idSS')->fetch();
            $sm = new Smartphone($item['idS']);
            $this->idSi = $sm->getItem();
            parent::$idScore = $item["idSScore"] ;
            parent::$scoreValue = $item["scoreValue"];
            parent::$creationDateTime = $item["creationDateime"];
    }

    public function update() {
        parent::update();
        $count = MDA::updateScore(parent::$idScore,parent::$scoreValue,parent::$creationDateTime,array('idSS',  $this->idS->getIdSm()))->rowCount();
        return $count;
    }

}
