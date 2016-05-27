<?php

namespace ORM_Entity;

use OmiumORM\Omium as ORM;
use Compared\LayerConnector\MDA as Model;

/**
 * Compared
 *
 * @ORM\Table(name="COMPARED", indexes={@ORM\Index(name="FK_sm1", columns={"idS1"}), @ORM\Index(name="FK_sm2", columns={"idS2"})})
 * @ORM\Entity
 */
class Compared implements ORM
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idCOMPARED", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCompared;

    /**
     * @var \Smartphone
     *
     * @ORM\ManyToOne(targetEntity="Smartphone")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idS1", referencedColumnName="idS")
     * })
     */
    private $idS1;

    /**
     * @var \Smartphone
     *
     * @ORM\ManyToOne(targetEntity="Smartphone")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idS2", referencedColumnName="idS")
     * })
     */
    private $idS2;
    
    public function __construct($idCompared,$idS1,$idS2) {
        $this->idCompared = $idCompared;
        $this->idS1 = $idS1;
        $this->idS2 = $idS2;
    }
    
    public function getIdCompared() {
        return $this->idCompared;
    }
    
    public function getIdS1() {
        return $this->idS1;
    }
    public function setIdS1($idS1) {
        $this->idS1 = $idS1;
    }
    
     public function getIdS2() {
        return $this->idS2;
    }
    public function setIdS2($idS2) {
        $this->idS1 = $idS2;
    }
    
    public function create() {
        parent::create();
        $count =  (new Model())->insertCompared($this->idS1, $this->idS2)->rowCount();
        return $count;
        
    }
    
    public function delete() {
        parent::delete();
        $count = (new Model())->deleteAllById('COMPARED', $this->idCompared,'idCOMPARED')->rowCount();
         return $count;
    }
    public function update() {
        parent::update();
        $count = (new Model())->updateCompared($this->idCompared, $this->idS1, $this->idS2)->rowCount();
        return $count;
    }

    public function getItem() {
        
    }

}
