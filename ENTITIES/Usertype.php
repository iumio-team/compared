<?php

use LayerConnector\MDA;


/**
 * Usertype
 *
 * @ORM\Table(name="UserType")
 * @ORM\Entity
 */
class Usertype implements Omium
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idUT", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idut;

    /**
     * @var string
     *
     * @ORM\Column(name="nameUT", type="string", length=50, nullable=true)
     */
    private $nameut;

    public function __construct($item) {
        switch ($item) {
            case is_array($item):
                 $this->idut = $item['$id'];
                 $this->nameut =$item['label'];

                break;

            default:
                $this->idut = $item;
                break;
        }
       
    }
    
    public function getIdut() {
        return $this->idut;
    }

    public function getNameut() {
        return $this->nameut;
    }

    public function setIdut($idut) {
        $this->idut = $idut;
    }

    public function setNameut($nameut) {
        $this->nameut = $nameut;
    }
    
    public  function create() {
        
    }

    public  function delete() {
        
    }

    public  function update() {
       
    }

    public function getItem() {
        $item = MDA::findAllById('UserType', $this->idut, 'idUT')->fetch();
        $this->nameut = $item['nameUT'];
    }

}
