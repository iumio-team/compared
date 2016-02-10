<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace ORM_Entity;

use OmiumORM\Omium as ORM;
use Compared\LayerConnector\MDA as Model;
/**
 * Description of SScore
 *
 * @author dany
 */
class SScore extends Score implements ORM {
    private $idS;

    public function __construct(int $idSScore, float $scoreValue = NULL, String $creationDateTime = NULL, Smartphone $idS = NULL) {
        if($scoreValue !== NULL && $creationDateTime !== NULL && $idS !== NULL)
        {
            parent::__construct($idSScore, $scoreValue, $creationDateTime);
//echo self::generateIdScore();
            $this->idS = $idS;

        }
        else
        {
            parent::__construct($idSScore);
        }

    }

    public function getIdS():Smartphone {
        return $this->idS;

    }

    public function setIdS(Smartphone $idS) {
        $this->idS = $idS;

    }
    /* static protected function toTableName():String {
      $tb = strtoupper(get_class($this));
      $firstLetter = $tb[0];
      $tb[0] = $tb[0]."_";
      return $tb;
      } */


    static private function generateIdScore():int {
        $lastId = (new Model())->countLine("idSScore", "S_SCORE")->rowCount();
        return $lastId;
    }

    public function create() {
        $count = (new Model())->insertScore( $this->scoreValue, $this->creationDateTime, array('idS', $this->idS->getIdSm()))->rowCount();
        echo $count;
    }

    public function delete() {
        $count = (new Model())->deleteAllById("S_SCORE", $this->idScore, 'idSS')->rowCount();
        return $count;

    }

    public function getItem() {
        $item = (new Model())->findAllById('S_SCORE', $this->idScore, 'idS')->fetch();
        $sm = new Smartphone($item['idS']);
        $sm->getItem();
        $this->idS = $sm;
        $this->idScore = $item["idSScore"];
        $this->scoreValue = $item["scoreValue"];
        $this->creationDateTime = $item["creationDateTime"];
    }

    public function update() {
        parent::update();
        $count = (new Model())->updateScore($this->idScore, $this->scoreValue, $this->creationDateTime, array('idSS', $this->idS->getIdSm()))->rowCount();
        return $count;
    }

}
