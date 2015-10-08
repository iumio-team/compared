<?php


use LayerConnector\MDA;

/**
 * Avis
 *
 * @ORM\Table(name="Avis")
 * @ORM\Entity
 */
class Notice implements Omium {

    /**
     * @var integer
     *
     * @ORM\Column(name="idA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ida;

    /**
     * @var string
     *
     * @ORM\Column(name="nomInter", type="string", length=50, nullable=false)
     */
    private $nominter;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=200, nullable=false)
     */
    private $content;

    public function __construct($ida, $nominter, $content) {
        $this->ida = $ida;
        $this->nominter = $nominter;
        $this->content = $content;
    }

    public function getIda() {
        return $this->ida;
    }

    public function getNominter() {
        return $this->nominter;
    }

    public function getContent() {
        return $this->content;
    }

    public function setIda($ida) {
        $this->ida = $ida;
    }

    public function setNominter($nominter) {
        $this->nominter = $nominter;
    }

    public function setContent($content) {
        $this->content = $content;
    }

     public function create() {
        parent::create();
        $count = MDA::insertNotice($this->nominter, $this->content)->rowCount();
        return $count;
    }

     public function delete() {
        parent::delete();
        $count = MDA::deleteAllById('Avis', $this->ida, 'idA')->rowCount();
        return $count;
    }

     public function update() {
        parent::update();
        $count = MDA::updateAvis($this->ida, $this->nominter, $this->content)->rowCount();
        return $count;
    }

    public function getItem() {
        
    }

}
