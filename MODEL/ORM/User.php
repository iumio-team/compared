<?php

namespace ORM_Entity;

use OmiumORM\Omium as ORM;
use ORM_Entity\Usertype;
use Compared\LayerConnector\MDA as Model;


class User implements ORM {

    private $userID;
    private $userLogin;
    private $userPassword;
    private $userFirstName;
    private $userLastname;
    private $userEmail;
    private $userPicture;
    private $userType;

    public function __construct($item) {

        switch ($item) {
            case is_array($item):

                $this->userID = $item['id'];

                $this->userLogin = $item['pseudo'];

                $this->userPassword = $item['password'];

                $this->userFirstName = $item['firstName'];

                $this->userLastName = $item['lastName'];

                $this->userEmail = $item['email'];

                $this->userPicture = $item['picture'];

                $this->userType = $item['userType'];
                break;

            default:
                $this->userID = $item;
                break;
        }
    }

    public function getUserID() {

        return $this->userID;
    }

    public function setUserID($userID) {

        $this->userID = $userID;
    }

    public function getUserLogin() {

        return $this->userLogin;
    }

    public function setUserLogin($userLogin) {

        $this->userLogin = $userLogin;
    }

    public function getUserPassword() {

        return $this->userPassword;
    }

    public function setUserPassword($userPassword) {

        $this->userPassword = $userPassword;
    }

    public function getUserFirstName() {

        return $this->userFirstName;
    }

    public function setUserFirstName($userFirstName) {

        $this->userFirstName = $userFirstName;
    }

    public function getUserLastname() {

        return $this->userLastname;
    }

    public function setUserLastname($userLastname) {

        $this->userLastname = $userLastname;
    }

    public function getUserEmail() {

        return $this->userEmail;
    }

    public function setUserEmail($userEmail) {

        $this->userEmail = $userEmail;
    }

    public function getUserPicture() {

        return $this->userPicture;
    }

    public function setUserPicture($userPicture) {

        $this->userPicture = $userPicture;
    }

    public function getUserType() {

        return $this->userType;
    }

    public function setUserType($userType) {

        $this->userType = $userType;
    }

    public function create() {
        parent::create();
    }

    public function delete() {
        parent::delete();
    }

    public function update() {
        parent::update();
    }

    public function getItem() {
        $item = (new Model())->findAllById('User', $this->userID, 'idU')->fetch();
        $this->userID = $item['idU'];

        $this->userLogin = $item['pseudoU'];

        $this->userPassword = $item['passwordU'];

        $this->userFirstName = $item['firstNameU'];

        $this->userLastName = $item['lastNameU'];

        $this->userEmail = $item['emailU'];

        $this->userPicture = $item['pictureU'];

        $us = new UserType($item['idUT']);
        $this->userType = $us->getItem();
    }

}
