<?php

namespace PrimitiveSocial\NestioApiWrapper;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Carbon\Carbon;
use PrimitiveSocial\NestioApiWrapper\NestioException;

class Nestio {

	protected $apiKey;

	protected $client;

	protected $container;
	
	protected $history;
	
	protected $stack;

	protected $callMethod = 'GET';

	protected $url;

	protected $primaryUri;

	protected $uri;

	protected $method;

	public $sendData = [];

	public $output;

	protected $errorindicator = FALSE;

	protected $error = '';

	public function __construct($apiKey = null, $version = 2) {

		$this->apiKey = $apiKey ?: config('nestio.api_key');

		if(!$this->apiKey) throw NestioException::noApiKey();

		$this->url = 'https://nestiolistings.com/';

		$this->primaryUri = 'api/v' . $version . '/';

		// Set up Guzzle History
		$this->container = [];

		$this->history = Middleware::history($this->container);

		$this->stack = HandlerStack::create();
		
		// Add the history middleware to the handler stack.
		$this->stack->push($this->history);

		// Set up Guzzle client
		$this->client = new Client(array(
			'base_uri' => $this->url . $this->primaryUri,
			'handler' => $this->stack,
			'headers' => array(
				'Content-Type' 		=> 'application/json',
				'Accept'       		=> 'application/json',
				// @TODO: Is this line needed?
				'user'				=> $this->apiKey,
			)
		));

	}

	public function output() {

		return $this->output;

	}

	public function request() {

		return array(
			'body' => $this->getBody(),
			'sendData' => $this->sendData
		);

	}

	public function error() {

		return array(
			'hasError' => $this->errorindicator,
			'errorMessage' => $this->error,
			'dump' => array(
				'output' => $this->output,
				'container' => $this->container[0],
				'body' => $this->getBody(),
				'sendData' => $this->sendData,
				'uri' => $this->versionUri . $this->uri
			)
		);

	}

	public function getBody() {

		$result = array();

		foreach ($this->container as $transaction) {

			$item = array();

			$item['method'] = $transaction['request']->getMethod();
		    
		    if ($transaction['response']) {
		        //> 200, 200
		        $item['status'] = 'success';

		        $item['code'] = $transaction['response']->getStatusCode();
		        
		    } elseif ($transaction['error']) {

		        $item['status'] = 'error';

		    }
		    
		    $item['data'] = $transaction['options'];
		    
		    $result[] = $item;
		}
		
		return json_encode($result);

	}

	protected function send() {

		$sendData = array_merge(
			array(
				'key' => $this->apiKey
			),
			$this->sendData
		);

		try {

			$response = $this->client->request(
				$this->callMethod,
				$this->uri,
				array(
					'query' => $sendData,
					'auth' => array(
						$this->apiKey,
						null
					)
				)
			);

		} catch (GuzzleHttp\Exception\ClientException $e) {

			throw NestioException::guzzleError($e->getMessage(), $this->getBody(), $this->sendData, $this->url . $this->primaryUri . $this->uri);

		} catch (\Exception $e) {

			throw NestioException::guzzleError($e->getMessage(), $this->getBody(), $this->sendData, $this->url . $this->primaryUri . $this->uri);

		} catch (\ErrorException $e) {

			throw NestioException::guzzleError($e->getMessage(), $this->getBody(), $this->sendData, $this->url . $this->primaryUri . $this->uri);

		}

		$this->output = json_decode($response->getBody(), TRUE);

		return $this;

	}

}