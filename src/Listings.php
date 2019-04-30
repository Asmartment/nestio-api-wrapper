<?php

namespace PrimitiveSocial\NestioApiWrapper;

use PrimitiveSocial\NestioApiWrapper\Nestio;
use PrimitiveSocial\NestioApiWrapper\Enums\Bathrooms;
use PrimitiveSocial\NestioApiWrapper\Enums\BuildingOwnership;
use PrimitiveSocial\NestioApiWrapper\Enums\CommercialUse;
use PrimitiveSocial\NestioApiWrapper\Enums\Doorman;
use PrimitiveSocial\NestioApiWrapper\Enums\Incentives;
use PrimitiveSocial\NestioApiWrapper\Enums\Layout;
use PrimitiveSocial\NestioApiWrapper\Enums\ListingType;
use PrimitiveSocial\NestioApiWrapper\Enums\Parking;
use PrimitiveSocial\NestioApiWrapper\Enums\Pets;
use PrimitiveSocial\NestioApiWrapper\Enums\PropertyType;
use PrimitiveSocial\NestioApiWrapper\Enums\Source;
use PrimitiveSocial\NestioApiWrapper\Enums\SortBy;
use PrimitiveSocial\NestioApiWrapper\NestioException;

class Listings extends Nestio {

	public function __construct($apiKey = null, $version = 2) {

		parent::__construct($apiKey, $version);

	}

	// Getters
	public function all() {

		$this->callMethod = 'GET';

		$this->uri = 'listings/all';

		$this->send();

		return $this->output();

	}

	public function byId($id = null) {

		if(!$id) throw NestioException::missingListingId();

		$this->callMethod = 'GET';

		$this->uri = 'listings/' . $id;

		$this->send();

		return $this->output();

	}

	public function residentialRentals() {

		$this->callMethod = 'GET';

		$this->uri = 'listings/residential/rentals';

		$this->send();

		return $this->output();

	}

	public function residentialSales() {

		$this->callMethod = 'GET';

		$this->uri = 'listings/residential/sales';

		$this->send();

		return $this->output();

	}

	public function commercialRentals() {

		$this->callMethod = 'GET';

		$this->uri = 'listings/commercial/rentals';

		$this->send();

		return $this->output();

	}

	public function commercialSales() {

		$this->callMethod = 'GET';

		$this->uri = 'listings/commercial/sales';

		$this->send();

		return $this->output();

	}

	// Setters
	public function agents($data) {

		if(!isset($this->sendData['agents']) || !is_array($this->sendData['agents'])) {

			$this->sendData['agents'] = array();

		}

		if(is_array($data)) {

			foreach ($data as $d) {

				$this->sendData['agents'][] = $d;

			}

		} else {

			$this->sendData['agents'][] = $data;

		}

		return $this;

	}

	public function geometry($data) {

		$this->sendData['geometry'] = $data;

		return $this;

	}

	public function listingType($data) {

		$vars = (new ListingType)->getConstants();

		foreach ($vars as $key => $value) {

			if($data == $value) {

				$this->sendData['listing_type'] = $vars[$key];

			}

		}

		return $this;

	}

	public function propertyType($data) {

		$vars = (new PropertyType)->getConstants();

		foreach ($vars as $key => $value) {

			if($data == $value) {

				$this->sendData['property_type'] = $vars[$key];

			}

		}

		return $this;

	}

	public function commercialUse($data) {

		if(!isset($this->sendData['commercial_use']) || !is_array($this->sendData['commercial_use'])) $this->sendData['commercial_use'] = array();

		$vars = (new CommercialUse)->getConstants();

		foreach ($vars as $key => $value) {

			if(is_array($data)) {

				if(in_array($value, $data)) {

					$this->sendData['commercial_use'][] = $vars[$key];

				}

			} else {

				if($data == $value) {

					$this->sendData['commercial_use'][] = $vars[$key];

				}

			}

		}

		return $this;

	}

	public function building($data) {

		if(!isset($this->sendData['building']) || !is_array($this->sendData['building'])) $this->sendData['building'] = array();

		if(is_array($data)) {

			$this->sendData['building'] = array_merge($this->sendData['building'], $data);

		} else {

			$this->sendData['building'][] = $data;

		}

		return $this;

	}

	public function buildingNameAddress($data) {
		
		$this->sendData['building_name_address'] = $data;

		return $this;

	}

	public function buildingOwnership($data) {

		if(!isset($this->sendData['building_ownership']) || !is_array($this->sendData['building_ownership'])) $this->sendData['building_ownership'] = array();

		$vars = (new BuildingOwnership)->getConstants();

		foreach ($vars as $key => $value) {

			if(is_array($data)) {

				if(in_array($value, $data)) {

					$this->sendData['commercial_use'][] = $vars[$key];

				}

			} elseif($data == $value) {

				$this->sendData['commercial_use'][] = $vars[$key];

			}

		}

		return $this;

	}

	public function company($data) {

		if(!isset($this->sendData['company']) || !is_array($this->sendData['company'])) $this->sendData['company'] = array();

		if(is_array($data)) {

			$this->sendData['company'] = array_merge($this->sendData['company'], $data);

		} else {

			$this->sendData['company'][] = $data;

		}

		return $this;

	}

	public function exclusive($data = true) {

		$this->sendData['exclusive'] = $data;

		return $this;

	}

	public function minPrice($data) {

		$this->sendData['min_price'] = $data;

		return $this;

	}

	public function maxPrice($data) {

		$this->sendData['max_price'] = $data;

		return $this;

	}

	public function elevator($data = true) {

		$this->sendData['elevator'] = $data;

		return $this;

	}

	public function doorman($data) {

		$vars = (new Doorman)->getConstants();

		foreach ($vars as $key => $value) {

			if($data == $value) {

				$this->sendData['doorman'] = $vars[$key];

			}

		}

		return $this;

	}

	public function pets($data) {

		if(!isset($this->sendData['pets']) || !is_array($this->sendData['pets'])) $this->sendData['pets'] = array();

		$vars = (new Pets)->getConstants();

		foreach ($vars as $key => $value) {

			if(is_array($data)) {

				if(in_array($value, $data)) {

					$this->sendData['pets'][] = $vars[$key];

				}

			} elseif($data == $value) {

				$this->sendData['pets'][] = $vars[$key];

			}

		}

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

	public function bathrooms($data) {

		$vars = (new Bathrooms)->getConstants();

		foreach ($vars as $key => $value) {

			if($data == $value) {

				$this->sendData['bathrooms'] = $vars[$key];

			}

		}

		return $this;

	}

	public function neighborhoods($data) {

		if(!isset($this->sendData['neighborhoods']) || !is_array($this->sendData['neighborhoods'])) $this->sendData['neighborhoods'] = array();

		if(is_array($data)) {

			$this->sendData['neighborhoods'] = array_merge($this->sendData['neighborhoods'], $data);

		} else {

			$this->sendData['neighborhoods'][] = $data;

		}

		return $this;

	}

	public function postalCode($data) {

		$this->sendData['postal_code'] = $data;

		return $this;

	}

	public function dateAvailableBefore($date) {

		$this->sendData['date_available_before'] = $data;

		return $this;

	}

	public function dateAvailableAfter($date) {

		$this->sendData['date_available_after'] = $data;

		return $this;

	}

	public function hasPhotos ($data = true) {

		$this->sendData['has_photos'] = $data;

	}

	public function incentives($data) {

		$vars = (new Incentives)->getConstants();

		foreach ($vars as $key => $value) {

			if($data == $value) {

				$this->sendData['incentives'] = $vars[$key];

			}

		}

		return $this;

	}

	public function openHouseBegin($date) {

		$this->sendData['open_house_begin'] = $date;

		return $this;

	}

	public function openHouseEnd($date) {

		$this->sendData['open_house_end'] = $date;

		return $this;

	}

	public function featured($data = true) {

		$this->sendData['featured'] = $data;

	}

	public function source($data) {

		$vars = (new Source)->getConstants();

		foreach ($vars as $key => $value) {

			if($data == $value) {

				$this->sendData['source'] = $vars[$key];

			}

		}

		return $this;

	}

	public function city($data) {

		$this->sendData['city'] = strtolower($data);

		return $this;

	}

	public function isRenovated($data = true) {

		$this->sendData['is_renovated'] = strtolower($data);

		return $this;

	}

	public function dishwasher($data = true) {

		$this->sendData['dishwasher'] = $data;

		return $this;

	}

	public function microwave($data = true) {

		$this->sendData['microwave'] = $data;

		return $this;

	}

	public function exposedBrick($data = true) {

		$this->sendData['exposed_brick'] = $data;

		return $this;

	}

	public function hardwoodFloors($data = true) {

		$this->sendData['hardwood_floors'] = $data;

		return $this;

	}

	public function virtualDoorman($data = true) {

		$this->sendData['virtual_doorman'] = $data;

		return $this;

	}

	public function storage($data = true) {

		$this->sendData['storage'] = $data;

		return $this;

	}

	public function shortTerm($data = true) {

		$this->sendData['short_term'] = $data;

		return $this;

	}

	public function liveInSuper($data = true) {

		$this->sendData['live_in_super'] = $data;

		return $this;

	}

	public function lastListedAtBefore($date) {

		$this->sendData['last_listed_at_before'] = $date;

		return $this;

	}

	public function lastListedAtAfter($date) {

		$this->sendData['last_listed_at_after'] = $date;

		return $this;

	}

	public function parking($data) {

		if(is_array($this->sendData['parking'])) $this->sendData['parking'] = array();

		$vars = (new Parking)->getConstants();

		foreach ($vars as $key => $value) {

			if(is_array($data)) {

				if(in_array($value, $data)) {

					$this->sendData['parking'][] = $vars[$key];

				}

			} elseif($data == $value) {

				$this->sendData['parking'][] = $vars[$key];

			}

		}

		return $this;

	}

	public function includePrivate($date) {

		$this->sendData['include_private'] = $date;

		return $this;

	}

	public function sort($data, $dir = 'asc') {

		$vars = (new SortBy)->getConstants();

		foreach ($vars as $key => $value) {

			if($data == $value) {

				$this->sendData['sort'] = $vars[$key];
				$this->sendData['sort_dir'] = $dir;

			}

		}

		return $this;

	}

	public function displayAgent($data) {

		$this->sendData['display_agent'] = $data;

		return $this;

	}

}