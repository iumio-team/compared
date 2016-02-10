<?php

/**
 * Description of Score
 *
 * @author dany
 */

namespace ORM_Entity;

class Score {
    
    protected $idScore;
    protected $scoreValue;
    protected $creationDateTime;
    
    public function __construct(int $idScore,float $scoreValue=NULL, String $creationDateTime=NULL){ 
        $this->idScore = $idScore;
        if($scoreValue !== NULL && $creationDateTime !== NULL){
            $this->scoreValue = $scoreValue;
            $this->creationDateTime = $creationDateTime;
        }

    }
    
    public function getIdScore():int {
        return $this->idScore;
    }
    public function getScoreValue():float {
        return $this->scoreValue;
    }
    public function getCreationDateTime():String {
        return $this->creationDateTime;
    }
    
    
    public function setIdScore(int $idScore):void {
        $this->idScore = $idScore;
    }
    public function setScoreValue(float $scoreValue):void {
        $this->scoreValue = $scoreValue;
    }
    public function setCreationDateTime(String $creationDateTime):void {
        $this->creationDateTime = $creationDateTime;
    }
    

}
