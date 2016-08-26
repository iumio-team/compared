<?php

namespace GException;

class ServiceError extends AbstractException {

	public function __construct(string $message) {
		parent::__construct($message, 'Service');
	}
}