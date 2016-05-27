<?php


namespace ORM_Entity;


/*
 * Class name : SimpleUser 
 * Extends of : User class
 */

class SimpleUser extends User {

	

	public function __construct($userID,$userLogin,$userPassword,$userFirstName,$userLastName,$userEmail,$userPicture,$userFunction) {

		parent::__construct($userID,$userLogin,$userPassword,$userFirstName,$userLastName,$userEmail,$userPicture,$userFunction);

	}

}