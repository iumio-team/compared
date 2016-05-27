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
class Articles extends Score implements ORM {
    private $id;
    private $idU;
    private $date;
    private $content;
    private $picture;
    private $shortDesc;
    private $title;

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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return mixed
     */
    public function getShortDesc()
    {
        return $this->shortDesc;
    }

    /**
     * @param mixed $shortDesc
     */
    public function setShortDesc($shortDesc)
    {
        $this->shortDesc = $shortDesc;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getIdU():User {
        return $this->idU;

    }

    public function setIdU(User $idU) {
        $this->idU = $idU;

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
