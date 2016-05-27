<?php

namespace GException;

class EngineComparatorException extends AbstractException {

	public function __construct(string $message) {
        parent::__construct($message, 'Engine comparator');
	}
}