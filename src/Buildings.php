<?php

namespace PrimitiveSocial\NestioApiWrapper;

use PrimitiveSocial\NestioApiWrapper\Nestio;

class Buildings extends Nestio {

	public function __construct($apiKey = null, $version = 2) {

		parent::__construct($apiKey, $version);

	}

	public function all() {

		$this->callMethod = 'GET';

		$this->uri = 'buildings';

		$this->send();

		return $this->output();

	}

}