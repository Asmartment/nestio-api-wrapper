<?php

if ( !isset( $_SESSION ) ) $_SESSION = array();

use PrimitiveSocial\NestioApiWrapper\Nestio;
use PrimitiveSocial\NestioApiWrapper\Listings;
use PrimitiveSocial\NestioApiWrapper\Buildings;
use PHPUnit\Framework\PHPUnit_Framework_TestCase;
use PrimitiveSocial\NestioApiWrapper\NestioException;

class NestioApiWrapperTest extends PHPUnit\Framework\TestCase
{

	public function testNestioCanGetAllListings() {

		$output = null;

		$client = new Listings('036c088b94ab48b9b170d6b3dcd30341');

		$output = $client->all();

		$_SESSION['all_no_filters'] = $output;

		$this->assertNotNull($output);

	}

	public function testNestioCanGetAllListingsWithFilters() {

		$output = null;

		$client = new Listings('036c088b94ab48b9b170d6b3dcd30341');

		// Adding filters
		$client->commercialUse('industrial');

		$output = $client->all();

		$_SESSION['all_no_filters'] = $output;

		$this->assertNotNull($output);

	}

	public function testNestioCanGetBuildings() {

		$output = null;

		$client = new Buildings('036c088b94ab48b9b170d6b3dcd30341');

		$output = $client->all();

		$this->assertNotNull($output);

	}
 
}