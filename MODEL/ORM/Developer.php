<?php


/*
 * Class name : Developer
 * Extends of : User class
 */

namespace ORM_Entity;

class Developer extends User {

	public function __construct($userID,$userLogin,$userPassword,$userFirstName,$userLastName,$userEmail,$userPicture,$userFunction){

		parent::__construct($userID,$userLogin,$userPassword,$userFirstName,$userLastName,$userEmail,$userPicture,$userFunction);

	}

}