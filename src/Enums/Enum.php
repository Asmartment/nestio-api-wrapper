<?php

namespace PrimitiveSocial\NestioApiWrapper\Enums;

abstract class Enum {

	public static function getConstants() {

		$oClass = new ReflectionClass(__CLASS__);

		return $oClass->getConstants();

	}

}