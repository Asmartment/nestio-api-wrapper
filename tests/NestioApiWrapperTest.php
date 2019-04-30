<?php

if ( !isset( $_SESSION ) ) $_SESSION = array();

use PrimitiveSocial\NestioApiWrapper\Nestio;
use PrimitiveSocial\NestioApiWrapper\Listings;
use PrimitiveSocial\NestioApiWrapper\Buildings;
use PrimitiveSocial\NestioApiWrapper\Agents;
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

	public function testNestioCanGetSpecificListing() {

		$output = null;

		$client = new Listings('036c088b94ab48b9b170d6b3dcd30341');

		// Adding filters
		$client->commercialUse('industrial');

		$output = $client->all();

		$this->assertNotNull($output);

		$listingFromOutput = $output['items'][0];

		$_SESSION['all_no_filters'] = $output;

		$listing = $client->byId($listingFromOutput['id']);

		$this->assertNotNull($listing);

	}

	public function testNestioCanGetBuildings() {

		$output = null;

		$client = new Buildings('036c088b94ab48b9b170d6b3dcd30341');

		$output = $client->all();

		$this->assertNotNull($output);

	}

	public function testNestioCanGetAgents() {

		$output = null;

		$client = new Agents('036c088b94ab48b9b170d6b3dcd30341');

		$output = $client->all();

		$this->assertNotNull($output);

	}

	public function testNestioCanGetSpecificAgent() {

		$output = null;

		$client = new Agents('036c088b94ab48b9b170d6b3dcd30341');

		$output = $client->all();

		$this->assertNotNull($output);

		$agentFromInitial = $output['items'][0];

		$agent = $client->byId($agentFromInitial['id']);

		$this->assertNotNull($agent);

	}
 
}