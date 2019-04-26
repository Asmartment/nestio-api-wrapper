<?php

if ( !isset( $_SESSION ) ) $_SESSION = array();

use PrimitiveSocial\NestioApiWrapper\Nestio;

class NestioApiWrapperTest extends PHPUnit_Framework_TestCase
{

	public function testNestioFailsWithoutApiKey() {

		$this->expectException(\PrimitiveSocial\NestioApiWrapper\NestioException::class);

		$client = new Nestio;

	}

}