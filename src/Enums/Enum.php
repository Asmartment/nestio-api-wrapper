<?php

namespace PrimitiveSocial\NestioApiWrapper\Enums;

abstract class Enum {

	public function getConstants() {

		$oClass = new \ReflectionClass($this);

		return $oClass->getConstants();

	}

}