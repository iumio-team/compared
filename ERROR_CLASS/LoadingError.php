<?php

namespace GException;

class LoadingError extends AbstractException {

	public function __construct(string $message) {
		parent::__construct($message, 'Loader');
	}
}