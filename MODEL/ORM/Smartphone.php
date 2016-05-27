<?php

namespace ORM_Entity;

use OmiumORM\Omium as ORM;
use Compared\LayerConnector\MDA as Model;

class Smartphone implements ORM {

    private $idSm, $codeNameSm, $fullNameSm, $constructorSm, $ramSm;
    private $weightSm;
    private $thinknessSm;
    private $heightSm;
    private $widthSm;
    private $releaseDateSm;
    private $priceSm;
    private $photoFrontSm;
    private $photoBackSm;
    private $internalStSm;
    private $externalStSm;
    private $batteryCSm;
    private $cNetworkSm;
    private $videoFrontSm;
    private $videoBackSm;
    private $pictureSm;
    private $screen;
    private $os;
    private $processor;
    private $GPU;
    private $creationDate;
    private $resolutionVideoBackSm;
    private $resolutionVideoFrontSm;

    public function __construct($item) {
        switch ($item) {
            case is_array($item): {
                    $idSm = $item['idSm'];
                    $codeNameSm = $item['codeName'];
                    $fullNameSm = $item['fullName'];
                    $constructorSm = $item['constructor'];
                    $ramSm = $item['ram'];
                    $weightSm = $item['weight'];
                    $thinknessSm = $item['thinkness'];
                    $heightSm = $item['height'];
                    $widthSm = $item['width'];
                    $releaseDateSm = $item['release'];
                    $priceSm = $item['price'];
                    $photoFrontSm = $item['photoFront'];
                    $photoBackSm = $item['photoBack'];
                    $internalStSm = $item['internalSt'];
                    $externalStSm = $item['externalSt'];
                    $batteryCSm = $item['batteryC'];
                    $cNetworkSm = $item['cNetwork'];
                    $videoFrontSm = $item['videoFront'];
                    $videoBackSm = $item['videoBack'];
                    $resolutionVideoFrontSm = $item['resolutionVideoFront'];
                    $resolutionVideoBackSm = $item['resolutionVideoBack'];
                    $pictureSm = $item['picture'];
                    $screen = new Screen($item['screen']);
                    $screen->getItem();
                    $os = new Os($item['os']);
                    $os->getItem();
                    $processor = new Processor($item['processor']);
                    $processor->getItem();
                    $GPU = new GPU($item['GPU']);
                    $GPU->getItem();

                    $this->idSm = $idSm;
                    $this->codeNameSm = $codeNameSm;
                    $this->fullNameSm = $fullNameSm;
                    $this->constructorSm = $constructorSm;
                    $this->ramSm = $ramSm;
                    $this->weightSm = $weightSm;
                    $this->thinknessSm = $thinknessSm;
                    $this->heightSm = $heightSm;
                    $this->widthSm = $widthSm;
                    $this->releaseDateSm = $releaseDateSm;
                    $this->priceSm = $priceSm;
                    $this->photoFrontSm = $photoFrontSm;
                    $this->photoBackSm = $photoBackSm;
                    $this->internalStSm = $internalStSm;
                    $this->externalStSm = $externalStSm;
                    $this->batteryCSm = $batteryCSm;
                    $this->cNetworkSm = $cNetworkSm;
                    $this->videoFrontSm = $videoFrontSm;
                    $this->videoBackSm = $videoBackSm;
                    $this->pictureSm = $pictureSm;
                    $this->screen = $screen;
                    $this->os = $os;
                    $this->processor = $processor;
                    $this->GPU = $GPU;
                    $this->creationDate = $item['creation_date'];
                    $this->resolutionVideoBackSm = $resolutionVideoBackSm;
                    $this->resolutionVideoFrontSm = $resolutionVideoFrontSm;
                }
                break;
            default :
                $this->idSm = $item;
        }
    }

    public function getIdSm() {
        return $this->idSm;
    }

    public function getCodeNameSm() {
        return $this->codeNameSm;
    }

    public function getFullNameSm() {
        return $this->fullNameSm;
    }

    public function getConstructorSm() {
        return $this->constructorSm;
    }

    public function getRamSm() {
        return $this->ramSm;
    }

    public function getWeightSm() {
        return $this->weightSm;
    }

    public function getThinknessSm() {
        return $this->thinknessSm;
    }

    public function getHeightSm() {
        return $this->heightSm;
    }

    public function getWidthSm() {
        return $this->widthSm;
    }

    public function getReleaseDateSm() {
        return $this->releaseDateSm;
    }

    public function getPriceSm() {
        return $this->priceSm;
    }

    public function getPhotoFrontSm() {
        return $this->photoFrontSm;
    }

    public function getPhotoBackSm() {
        return $this->photoBackSm;
    }

    public function getInternalStSm() {
        return $this->internalStSm;
    }

    public function getExternalStSm() {
        return $this->externalStSm;
    }

    public function getBatteryCSm() {
        return $this->batteryCSm;
    }

    public function getCNetworkSm() {
        return $this->cNetworkSm;
    }

    public function getVideoFrontSm() {
        return $this->videoFrontSm;
    }

    public function getVideoBackSm() {
        return $this->videoBackSm;
    }

    public function getPictureSm() {
        return $this->pictureSm;
    }

    public function getScreen() {
        return $this->screen;
    }

    public function getOs() {
        return $this->os;
    }

    public function getProcessor() {
        return $this->processor;
    }

    public function getGPU() {
        return $this->GPU;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function setIdSm($idSm) {
        $this->idSm = $idSm;
    }

    public function setCodeNameSm($codeNameSm) {
        $this->codeNameSm = $codeNameSm;
    }

    public function setFullNameSm($fullNameSm) {
        $this->fullNameSm = $fullNameSm;
    }

    public function setConstructorSm($constructorSm) {
        $this->constructorSm = $constructorSm;
    }

    public function setRamSm($ramSm) {
        $this->ramSm = $ramSm;
    }

    public function setWeightSm($weightSm) {
        $this->weightSm = $weightSm;
    }

    public function setThinknessSm($thinknessSm) {
        $this->thinknessSm = $thinknessSm;
    }

    public function setHeightSm($heightSm) {
        $this->heightSm = $heightSm;
    }

    public function setWidthSm($widthSm) {
        $this->widthSm = $widthSm;
    }

    public function setReleaseDateSm($releaseDateSm) {
        $this->releaseDateSm = $releaseDateSm;
    }

    public function setPriceSm($priceSm) {
        $this->priceSm = $priceSm;
    }

    public function setPhotoFrontSm($photoFrontSm) {
        $this->photoFrontSm = $photoFrontSm;
    }

    public function setPhotoBackSm($photoBackSm) {
        $this->photoBackSm = $photoBackSm;
    }

    public function setInternalStSm($internalStSm) {
        $this->internalStSm = $internalStSm;
    }

    public function setExternalStSm($externalStSm) {
        $this->externalStSm = $externalStSm;
    }

    public function setBatteryCSm($batteryCSm) {
        $this->batteryCSm = $batteryCSm;
    }

    public function setCNetworkSm($cNetworkSm) {
        $this->cNetworkSm = $cNetworkSm;
    }

    public function setVideoFrontSm($videoFrontSm) {
        $this->videoFrontSm = $videoFrontSm;
    }

    public function setVideoBackSm($videoBackSm) {
        $this->videoBackSm = $videoBackSm;
    }

    public function setPictureSm($pictureSm) {
        $this->pictureSm = $pictureSm;
    }

    public function setScreen($screen) {
        $this->screen = $screen;
    }

    public function setOs($os) {
        $this->os = $os;
    }

    public function getResolutionVideoFrontSm() {
        return $this->resolutionVideoFrontSm;
    }

    public function setResolutionVideoFrontSm($resolutionVideoFrontSm) {
        $this->resolutionVideoFrontSm = $resolutionVideoFrontSm;
    }

    public function getResolutionVideoBackSm() {
        return $this->resolutionVideoBackSm;
    }

    public function setResolutionVideoBackSm($resolutionVideoBackSm) {
        $this->resolutionVideoBackSm = $resolutionVideoBackSm;
    }

    public function setProcessor($processor) {
        $this->processor = $processor;
    }

    public function setGPU($GPU) {
        $this->GPU = $GPU;
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

    /** Get a smartphone by its identifier
     */
    public function getItem() {

        $item = (new Model())->findAllById('Smartphone', $this->idSm, 'idS')->fetch();
        $codeNameSm = $item['codeNameS'];
        $fullNameSm = $item['fullNameS'];
        $constructor = new Constructor($item['constructorS']);
        $constructor->getItem();
        $constructorSm = $constructor;
        $ramSm = $item['ramS'];
        $weightSm = $item['weightS'];
        $thinknessSm = $item['thinknessS'];
        $heightSm = $item['heightS'];
        $widthSm = $item['widthS'];
        $releaseDateSm = $item['releaseDateS'];
        $priceSm = $item['priceS'];
        $photoFrontSm = $item['photoFrontS'];
        $photoBackSm = $item['photoBackS'];
        $internalStSm = $item['internalStorageS'];
        $externalStSm = $item['externalStorageS'];
        $batteryCSm = $item['batteryCapacityS'];
        $cNetworkSm = $item['cNetworkS'];
        $videoFrontSm = $item['videoFrontS'];
        $videoBackSm = $item['videoBackS'];
        $resolutionVideoFrontSm = $item['resolutionVideoFront'];
        $resolutionVideoBackSm = $item['resolutionVideoBack'];
        $pictureSm = $item['pictureS'];
        $screen = new Screen($item['idScr']);
        $screen->getItem();
        $os = new Os($item['idOS']);
        $os->getItem();
        $processor = new Processor($item['idProc']);
        $processor->getItem();
        $GPU = new GPU($item['idG']);
        $GPU->getItem();
        $this->codeNameSm = $codeNameSm;
        $this->fullNameSm = $fullNameSm;
        $this->constructorSm = $constructorSm;
        $this->ramSm = $ramSm;
        $this->weightSm = $weightSm;
        $this->thinknessSm = $thinknessSm;
        $this->heightSm = $heightSm;
        $this->widthSm = $widthSm;
        $this->releaseDateSm = $releaseDateSm;
        $this->priceSm = $priceSm;
        $this->photoFrontSm = $photoFrontSm;
        $this->photoBackSm = $photoBackSm;
        $this->internalStSm = $internalStSm;
        $this->externalStSm = $externalStSm;
        $this->batteryCSm = $batteryCSm;
        $this->cNetworkSm = $cNetworkSm;
        $this->videoFrontSm = $videoFrontSm;
        $this->videoBackSm = $videoBackSm;
        $this->pictureSm = $pictureSm;
        $this->screen = $screen;
        $this->os = $os;
        $this->processor = $processor;
        $this->GPU = $GPU;
        $this->creationDate = $item['creation_date'];
        $this->resolutionVideoBackSm = $resolutionVideoBackSm;
        $this->resolutionVideoFrontSm = $resolutionVideoFrontSm;
    }

}
