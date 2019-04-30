<?php

namespace PrimitiveSocial\NestioApiWrapper;

use PrimitiveSocial\NestioApiWrapper\Nestio;
use PrimitiveSocial\NestioApiWrapper\NestioException;

class People extends Nestio {

	protected $data;

	public function __construct() {

		$this->data = array();

	}

	// Getters
	public function output() {

		return $this->data;

	}

	// Setters
	public function first_name($data) {

		$this->data['first_name'] = $data;

	}
	public function last_name($data) {

		$this->data['last_name'] = $data;

	}
	public function email($data) {

		$this->data['email'] = $data;

	}
	public function phone_1($data) {

		$this->data['phone_1'] = $data;

	}
	public function phone_2($data) {

		$this->data['phone_2'] = $data;

	}
	public function is_primary($data = true) {

		$this->data['is_primary'] = $data;

	}

}