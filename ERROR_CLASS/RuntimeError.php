<?php

namespace GException;

class RuntimeError extends AbstractException {

	public function __construct(string $message) {
		parent::__construct($message, 'Runtime');
	}
}