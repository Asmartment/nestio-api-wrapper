<?php

namespace PrimitiveSocial\NestioApiWrapper;

use PrimitiveSocial\NestioApiWrapper\Nestio;

class Agents extends Nestio {

	public function __construct($apiKey = null, $version = 2) {

		parent::__construct($apiKey, $version);

	}

	public function all() {

		$this->callMethod = 'GET';

		$this->uri = 'agents';

		$this->send();

		return $this->output();

	}

}