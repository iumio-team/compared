<?php

namespace GException;

class RequestError extends AbstractException {

	public function __construct(string $type, string $message) {
		parent::__construct($message, $type);
	}
}