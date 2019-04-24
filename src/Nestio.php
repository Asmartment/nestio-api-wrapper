<?php

namespace PrimitiveSocial\NestioApiWrapper;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Carbon\Carbon;

class Nestio {

	protected $apiKey;

	protected $client;

	protected $url;

	public function construct($apiKey, $version = 2) {

		$apiKey = $apiKey ?: config('nestio.api_key');

		$this->url = 'https://nestiolistings.com/api/v' . $version;

		// Set up Guzzle History
		$this->container = [];

		$this->history = Middleware::history($this->container);

		$this->stack = HandlerStack::create();
		
		// Add the history middleware to the handler stack.
		$this->stack->push($this->history);

		// Set up Guzzle client
		$this->client = new Client(array(
			'base_uri' => $this->clientUrl,
			'handler' => $this->stack,
			'headers' => array(
				'Content-Type' 		=> 'application/json',
				'Accept'       		=> 'application/json'
			)
		));

	}

}