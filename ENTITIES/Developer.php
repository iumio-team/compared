<?php

use LayerConnector\MDA;
/*
 * Class name : Developer
 * Extends of : User class
 */

require_once(realpath(dirname(__FILE__)) . '/User.php');



class Developer extends User {

	public function __construct($userID,$userLogin,$userPassword,$userFirstName,$userLastName,$userEmail,$userPicture,$userFunction){

		parent::__construct($userID,$userLogin,$userPassword,$userFirstName,$userLastName,$userEmail,$userPicture,$userFunction);

	}

}