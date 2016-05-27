<?php

namespace GException;

/**
 * This is a could to DATABASE EXCEPTIONS
 * @author RAFINA
 */

class PDORNException extends AbstractException{

	public function _construct(string $message) {
		parent::__construct($message, 'Database connection');
	}
}