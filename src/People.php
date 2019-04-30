<?php

namespace PrimitiveSocial\NestioApiWrapper;

use PrimitiveSocial\NestioApiWrapper\Nestio;
use PrimitiveSocial\NestioApiWrapper\NestioException;

class People extends Nestio {

	public $data;

	public function __construct() {

		$this->data = array();

	}

	// Getters
	public function getData() {

		return $this->data;

	}

	// Setters
	public function first_name($data) {

		$this->data['first_name'] = $data;

		return $this;

	}

	public function last_name($data) {

		$this->data['last_name'] = $data;

		return $this;

	}

	public function email($data) {

		$this->data['email'] = $data;

		return $this;

	}

	public function phone_1($data) {

		$this->data['phone_1'] = $data;

		return $this;

	}

	public function phone_2($data) {

		$this->data['phone_2'] = $data;

		return $this;

	}

	public function is_primary($data = true) {

		$this->data['is_primary'] = $data;

		return $this;

	}


}