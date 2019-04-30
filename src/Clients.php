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

	protected $people = array();

	public function __construct($apiKey = null, $version = 2) {

		parent::__construct($apiKey, $version);

	}

	// Getters
	public function submit() {

		$this->callMethod = 'POST';

		$this->uri = 'clients';

		// Parse people
		$this->sendData['people'] = array();

		foreach ($this->people as $p) {

			$this->sendData['people'][] = $p->output();

		}

		$this->send();

		return $this->output();

	}

	// Setters
	public function person($data) {

		$person = new People();

		foreach ($data as $key => $value) {
			$person->{$key} = $value;
		}

		$this->people[] = $person;

	}

	public function moveInDate($date) {

		$this->sendData['move_in_date'] = $date;

		return $this;

	}

	public function layout($data) {

		if(!isset($this->sendData['layout']) || !is_array($this->sendData['layout'])) $this->sendData['layout'] = array();

		$vars = Layout::getConstants();

		foreach ($vars as $key => $value) {

			if(is_array($data)) {

				if(in_array($value, $data)) {

					$this->sendData['layout'][] = Layout::$key;

				}

			} elseif($data == $value) {

				$this->sendData['layout'][] = Layout::$key;

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

	public function broker_company($data) {

		$this->sendData['broker_company'] = $data;

		return $this;

	}

	public function broker_email($data) {

		$this->sendData['broker_email'] = $data;

		return $this;

	}

	public function broker_first_name($data) {

		$this->sendData['broker_first_name'] = $data;

		return $this;

	}

	public function broker_last_name($data) {

		$this->sendData['broker_last_name'] = $data;

		return $this;

	}

	public function broker_phone($data) {

		$this->sendData['broker_phone'] = $data;

		return $this;

	}

	public function client_referral($data) {

		$this->sendData['client_referral'] = $data;

		return $this;

	}

	public function campaign_info($data) {

		$this->sendData['campaign_info'] = $data;

		return $this;

	}

	public function unit($data) {

		$this->sendData['unit'] = $data;

		return $this;

	}

	public function discoverySource($data) {

		if(!isset($this->sendData['discovery_source']) || !is_array($this->sendData['discovery_source'])) $this->sendData['discovery_source'] = array();

		$vars = DiscoverySource::getConstants();

		foreach ($vars as $key => $value) {

			if(is_array($data)) {

				if(in_array($value, $data)) {

					$this->sendData['discovery_source'][] = DiscoverySource::$key;

				}

			} else {

				if($data == $value) {

					$this->sendData['discovery_source'][] = DiscoverySource::$key;

				}

			}

		}

		return $this;

	}

	public function leadSource($data) {

		if(!isset($this->sendData['lead_source']) || !is_array($this->sendData['lead_source'])) $this->sendData['lead_source'] = array();

		$vars = LeadSource::getConstants();

		foreach ($vars as $key => $value) {

			if(is_array($data)) {

				if(in_array($value, $data)) {

					$this->sendData['lead_source'][] = LeadSource::$key;

				}

			} else {

				if($data == $value) {

					$this->sendData['lead_source'][] = LeadSource::$key;

				}

			}

		}

		return $this;

	}

	public function device($data) {

		if(!isset($this->sendData['device']) || !is_array($this->sendData['device'])) $this->sendData['device'] = array();

		$vars = Device::getConstants();

		foreach ($vars as $key => $value) {

			if(is_array($data)) {

				if(in_array($value, $data)) {

					$this->sendData['device'][] = Device::$key;

				}

			} else {

				if($data == $value) {

					$this->sendData['device'][] = Device::$key;

				}

			}

		}

		return $this;

	}

	public function sourceType($data) {

		if(!isset($this->sendData['source_type']) || !is_array($this->sendData['source_type'])) $this->sendData['source_type'] = array();

		$vars = SourceType::getConstants();

		foreach ($vars as $key => $value) {

			if(is_array($data)) {

				if(in_array($value, $data)) {

					$this->sendData['source_type'][] = SourceType::$key;

				}

			} else {

				if($data == $value) {

					$this->sendData['source_type'][] = SourceType::$key;

				}

			}

		}

		return $this;

	}

}