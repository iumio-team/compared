<?php


use LayerConnector\MDA;
/*
 * Class name : SimpleUser 
 * Extends of : User class
 */

require_once(realpath(dirname(__FILE__)) . '/User.php');

class SimpleUser extends User {

	

	public function __construct($userID,$userLogin,$userPassword,$userFirstName,$userLastName,$userEmail,$userPicture,$userFunction) {

		parent::__construct($userID,$userLogin,$userPassword,$userFirstName,$userLastName,$userEmail,$userPicture,$userFunction);

	}



}