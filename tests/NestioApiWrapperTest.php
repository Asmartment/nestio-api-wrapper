<?php

use PrimitiveSocial\NestioApiWrapper\Nestio;
use PrimitiveSocial\NestioApiWrapper\Listings;
use PrimitiveSocial\NestioApiWrapper\Buildings;
use PrimitiveSocial\NestioApiWrapper\Agents;
use PrimitiveSocial\NestioApiWrapper\Neighborhoods;
use PrimitiveSocial\NestioApiWrapper\Clients;
use PrimitiveSocial\NestioApiWrapper\People;
use PHPUnit\Framework\PHPUnit_Framework_TestCase;
use PrimitiveSocial\NestioApiWrapper\NestioException;

class NestioApiWrapperTest extends PHPUnit\Framework\TestCase
{

	public const APIKEY = "";

	public function testNestioCanGetAllListings() {

		$output = null;

		$client = new Listings(self::APIKEY);

		$output = $client->all();

		$this->assertNotNull($output);

	}

	public function testNestioCanGetAllListingsWithFilters() {

		$output = null;

		$client = new Listings(self::APIKEY);

		// Adding filters
		$client->commercialUse('industrial');

		$output = $client->all();

		$this->assertNotNull($output);

	}

	public function testNestioCanGetSpecificListing() {

		$output = null;

		$client = new Listings(self::APIKEY);

		// Adding filters
		$client->commercialUse('industrial');

		$output = $client->all();

		$this->assertNotNull($output);

		$listingFromOutput = $output['items'][0];

		$listing = $client->byId($listingFromOutput['id']);

		$this->assertNotNull($listing);

	}

	public function testNestioCanGetBuildings() {

		$output = null;

		$client = new Buildings(self::APIKEY);

		$output = $client->all();

		$this->assertNotNull($output);

	}

	public function testNestioCanGetAgents() {

		$output = null;

		$client = new Agents(self::APIKEY);

		$output = $client->all();

		$this->assertNotNull($output);

	}

	public function testNestioCanGetSpecificAgent() {

		$output = null;

		$client = new Agents(self::APIKEY);

		$output = $client->all();

		$this->assertNotNull($output);

		$agentFromInitial = $output['items'][0];

		$agent = $client->byId($agentFromInitial['id']);

		$this->assertNotNull($agent);

	}

	public function testNestioCanGetNeighborhood() {

		$output = null;

		$client = new Neighborhoods(self::APIKEY);

		$output = $client->all();

		$this->assertNotNull($output);

	}

	public function testNestioCanGetNeighborhoodWithParams() {

		$output = null;

		$client = new Neighborhoods(self::APIKEY);

		$output = $client->city('Philadelphia')
						->state('PA')
						->all();

		$this->assertNotNull($output);

	}

	public function testNestioCanCreateClients() {

		$output = null;

		$client = new Clients(self::APIKEY);

		// Create person
		$client->person([
			'first_name'	=> 'Gerbil',
			'last_name'		=> 'McPherson',
			'email'			=> 'nestio@example.com',
			'phone_1'		=> '215-555-5555',
			'is_primary'	=> true
		]);

		$client->moveInDate('2019-06-01')
				->group('1234')
				->layout('1br')
				->clientReferral('Ted McGinley')
				->discoverySource('zillow')
				->device('phone')
				->sourceType('organic');

		$output = $client->submit();

		$this->assertNotNull($output);

	}
 
}