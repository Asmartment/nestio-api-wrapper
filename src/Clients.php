<?php

namespace PrimitiveSocial\NestioApiWrapper;

use PrimitiveSocial\NestioApiWrapper\Nestio;
use PrimitiveSocial\NestioApiWrapper\NestioException;
use PrimitiveSocial\NestioApiWrapper\People;
use PrimitiveSocial\NestioApiWrapper\Enums\Layout;
use PrimitiveSocial\NestioApiWrapper\Enums\DiscoverySource;
use PrimitiveSocial\NestioApiWrapper\Enums\LeadSource;
use PrimitiveSocial\NestioApiWrapper\Enums\Device;
use PrimitiveSocial\NestioApiWrapper\Enums\SourceType;

class Clients extends Nestio {

	public $people = array();

	public function __construct($apiKey = null, $version = 2) {

		parent::__construct($apiKey, $version);

	}

	// Getters
	public function submit() {

		$this->callMethod = 'POST';

		$this->uri = 'clients';

		// Check for errors
		if(empty($this->people)) {

			throw NestioException::clientMissingPerson();


		}

		if(!isset($this->sendData['group'])) {

			throw NestioException::clientMissingGroup();

		}

		// Parse people
		$this->sendData['people'] = array();

		foreach ($this->people as $p) {

			$person = $p->getData();

			if(!isset($person['first_name'])) {

				throw NestioException::clientMissingPersonFirstName();

			}

			if(!isset($person['last_name'])) {

				throw NestioException::clientMissingPersonLastName();

			}

			$this->sendData['people'][] = $p->getData();

		}

		$this->send();

		return $this->output();

	}

	public function send() {

		$sendData = array_merge(
			array(
				'key' => $this->apiKey
			),
			array(
				'client' => $this->sendData
			)
		);

		try {

			$response = $this->client->request(
				$this->callMethod,
				$this->uri,
				array(
					'json' => $sendData,
					'auth' => array(
						$this->apiKey,
						null
					)
				)
			);

		} catch (GuzzleHttp\Exception\ClientException $e) {

			throw NestioException::guzzleError($e->getResponse()->getBody()->getContents(), $this->getBody(), $this->sendData, $this->url . $this->primaryUri . $this->uri);

		} catch (\Exception $e) {

			throw NestioException::guzzleError($e->getResponse()->getBody()->getContents(), $this->getBody(), $this->sendData, $this->url . $this->primaryUri . $this->uri);

		} catch (\ErrorException $e) {

			throw NestioException::guzzleError($e->getResponse()->getBody()->getContents(), $this->getBody(), $this->sendData, $this->url . $this->primaryUri . $this->uri);

		}

		$this->output = json_decode($response->getBody(), TRUE);

		return $this;
	}

	// Setters
	public function person($data) {

		$person = new People();

		foreach ($data as $key => $value) {

			$person->{$key}($value);

		}

		$this->people[] = $person;

		return $this;

	}

	public function moveInDate($date) {

		$this->sendData['move_in_date'] = $date;

		return $this;

	}

	public function layout($data) {

		if(!isset($this->sendData['layout']) || !is_array($this->sendData['layout'])) $this->sendData['layout'] = array();

		$vars = (new Layout)->getConstants();

		foreach ($vars as $key => $value) {

			if(is_array($data)) {

				if(in_array($value, $data)) {

					$this->sendData['layout'][] = $vars[$key];

				}

			} elseif($data == $value) {

				$this->sendData['layout'][] = $vars[$key];

			}

		}

		return $this;

	}

	public function price_floor($data) {

		$this->sendData['price_floor'] = $data;

		return $this;

	}

	public function price_ceiling($data) {

		$this->sendData['price_ceiling'] = $data;

		return $this;

	}

	public function notes($data) {

		$this->sendData['notes'] = $data;

		return $this;

	}

	public function group($data) {

		$this->sendData['group'] = $data;

		return $this;

	}

	public function brokerCompany($data) {

		$this->sendData['broker_company'] = $data;

		return $this;

	}

	public function brokerEmail($data) {

		$this->sendData['broker_email'] = $data;

		return $this;

	}

	public function brokerFirstName($data) {

		$this->sendData['broker_first_name'] = $data;

		return $this;

	}

	public function brokerLastName($data) {

		$this->sendData['broker_last_name'] = $data;

		return $this;

	}

	public function brokerPhone($data) {

		$this->sendData['broker_phone'] = $data;

		return $this;

	}

	public function clientReferral($data) {

		$this->sendData['client_referral'] = $data;

		return $this;

	}

	public function campaignInfo($data) {

		$this->sendData['campaign_info'] = $data;

		return $this;

	}

	public function unit($data) {

		$this->sendData['unit'] = $data;

		return $this;

	}

	public function discoverySource($data) {

		if(!isset($this->sendData['discovery_source']) || !is_array($this->sendData['discovery_source'])) $this->sendData['discovery_source'] = array();

		$vars = (new DiscoverySource)->getConstants();

		foreach ($vars as $key => $value) {

			if(is_array($data)) {

				if(in_array($value, $data)) {

					$this->sendData['discovery_source'][] = $vars[$key];

				}

			} else {

				if($data == $value) {

					$this->sendData['discovery_source'][] = $vars[$key];

				}

			}

		}

		return $this;

	}

	public function leadSource($data) {

		if(!isset($this->sendData['lead_source']) || !is_array($this->sendData['lead_source'])) $this->sendData['lead_source'] = array();

		$vars = (new LeadSource)->getConstants();

		foreach ($vars as $key => $value) {

			if(is_array($data)) {

				if(in_array($value, $data)) {

					$this->sendData['lead_source'][] = $vars[$key];

				}

			} else {

				if($data == $value) {

					$this->sendData['lead_source'][] = $vars[$key];

				}

			}

		}

		return $this;

	}

	public function device($data) {

		if(!isset($this->sendData['device']) || !is_array($this->sendData['device'])) $this->sendData['device'] = array();

		$vars = (new Device)->getConstants();

		foreach ($vars as $key => $value) {

			if(is_array($data)) {

				if(in_array($value, $data)) {

					$this->sendData['device'][] = $vars[$key];

				}

			} else {

				if($data == $value) {

					$this->sendData['device'][] = $vars[$key];

				}

			}

		}

		return $this;

	}

	public function sourceType($data) {

		if(!isset($this->sendData['source_type']) || !is_array($this->sendData['source_type'])) $this->sendData['source_type'] = array();

		$vars = (new SourceType)->getConstants();

		foreach ($vars as $key => $value) {

			if(is_array($data)) {

				if(in_array($value, $data)) {

					$this->sendData['source_type'][] = $vars[$key];

				}

			} else {

				if($data == $value) {

					$this->sendData['source_type'][] = $vars[$key];

				}

			}

		}

		return $this;

	}

}