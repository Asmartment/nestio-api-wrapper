<?php

namespace PrimitiveSocial\NestioApiWrapper;

use PrimitiveSocial\NestioApiWrapper\Nestio;
use PrimitiveSocial\NestioApiWrapper\NestioException;

class Neighborhoods extends Nestio {

	public function __construct($apiKey = null, $version = 2) {

		parent::__construct($apiKey, $version);

	}

	// Getters
	public function all() {

		$this->callMethod = 'GET';

		$this->uri = 'neighborhoods';

		$this->send();

		return $this->output();

	}

	// Setters
	public function city($data) {

		$this->sendData['city'] = $data;

		return $this;

	}

	public function state($data) {

		$this->sendData['state'] = $data;

		return $this;

	}

}