<?php

namespace PrimitiveSocial\NestioApiWrapper;

use Nestio;
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

class Listings extends Nestio {

	// GET /api/v2/listings/all
	// GET /api/v2/listings/residential/rentals/
	// GET /api/v2/listings/residential/sales/
	// GET /api/v2/listings/commercial/rentals/
	// GET /api/v2/listings/commercial/sales/

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

		$vars = ListingType::getConstants();

		foreach ($vars as $key => $value) {

			if($data == $value) {

				$this->sendData['listing_type'] = ListingType::$key;

			}

		}

		return $this;

	}

	public function propertyType($data) {

		$vars = PropertyType::getConstants();

		foreach ($vars as $key => $value) {

			if($data == $value) {

				$this->sendData['property_type'] = PropertyType::$key;

			}

		}

		return $this;

	}

	public function commercialUse($data) {

		$vars = CommercialUse::getConstants();

		foreach ($vars as $key => $value) {

			if($data == $value) {

				$this->sendData['commercial_use'] = CommercialUse::$key;

			}

		}

		return $this;

	}

	public function building($data) {
		// @TODO: How does Nestio read this building data? Array or string? Delimiter?

		$this->sendData['building'] = $data;

		return $this;

	}

	public function buildingNameAddress($data) {
		
		$this->sendData['building_name_address'] = $data;

		return $this;

	}

	public function buildingOwnership($data) {

		$vars = BuildingOwnership::getConstants();

		foreach ($vars as $key => $value) {

			if($data == $value) {

				$this->sendData['building_ownership'] = BuildingOwnership::$key;

			}

		}

		return $this;

	}

	public function company($data) {
		// @TODO: How does Nestio read this company data? Array or string? Delimiter?

		$this->sendData['company'] = $data;

		return $this;

	}

	public function exclusive($data = false) {

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

	public function elevator($data = false) {

		$this->sendData['elevator'] = $data;

		return $this;

	}

	public function doorman($data) {

		$vars = Doorman::getConstants();

		foreach ($vars as $key => $value) {

			if($data == $value) {

				$this->sendData['doorman'] = Doorman::$key;

			}

		}

		return $this;

	}

	public function pets($data) {

		$vars = Pets::getConstants();

		foreach ($vars as $key => $value) {

			if($data == $value) {

				$this->sendData['pets'] = Pets::$key;

			}

		}

		return $this;

	}

	public function layout($data) {

		$vars = Layout::getConstants();

		foreach ($vars as $key => $value) {

			if($data == $value) {

				$this->sendData['layout'] = Layout::$key;

			}

		}

		return $this;

	}

	public function bathrooms($data) {

		$vars = Bathrooms::getConstants();

		foreach ($vars as $key => $value) {

			if($data == $value) {

				$this->sendData['bathrooms'] = Bathrooms::$key;

			}

		}

		return $this;

	}

	public function neighborhoods($data) {

		// @TODO: How does Nestio read this neighborhoods data? Array or string? Delimiter?
		$this->sendData['neighborhoods'] = $data;

		return $this;

	}

}