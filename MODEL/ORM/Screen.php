<?php

namespace ORM_Entity;

use OmiumORM\Omium as ORM;
use Compared\LayerConnector\MDA as Model;

class Screen implements ORM {

	private $idS;

	private $typeS;

	private $resolutionS;

	private $densityS;

	private $sizeS;

	private $capacityS;

	public function __construct($arg) {
		switch($arg){
			case is_array($arg):
				$this->idS=$arg['id'];

				$this->typeS= $arg['type'];

				$this->resolutionS =$arg['resolution'];

				$this->densityS = $arg['density'];

				$this->sizeS =$arg['size'];

				$this->capacityS = $arg['capacity'];

				break;
			default :
				$this->idS = $arg;


		}
	}

	public function getIdS(){

		return $this->idS;

	}

	

	public function setIdS($idS){

		$this->idS = $idS;

	}

	

	public function getTypeS(){

		return $this->typeS;

	}

	

	public function setTypeS($typeS){

		$this->typeS = $typeS;

	}

	

	public function getResolutionS(){

		return $this->resolutionS;

	}

	

	public function setResolutionS($resolutionS){

		$this->resolutionS = $resolutionS;

	}

	

	public function getDensityS(){

		return $this->densityS;

	}

	

	public function setDensityS($densityS){

		$this->densityS = $densityS;

	}

	

	public function getSizeS(){

		return $this->sizeS;

	}

	

	public function setSizeS($sizeS){

		$this->sizeS = $sizeS;

	}

	

	public function getCapacityS(){

		return $this->capacityS;

	}

	

	public function setCapacityS($capacityS){

		$this->capacityS = $capacityS;

	}

	function create() {
		parent::create();
	}

	public function delete() {
		parent::delete();
	}

	public function update() {
		parent::update();
	}

	public function getItem(){
		$result = (new Model())->findAllById('Screen',$this->idS,'idScr')->fetch();
		$this->typeS = $result['typeScr'];
		$this->resolutionS = $result['resolutionScr'];
		$this->densityS = $result['densityScr'];
		$this->sizeS = $result['sizeScr'];
		$this->capacityS = $result['capacityScr'];
	}
}