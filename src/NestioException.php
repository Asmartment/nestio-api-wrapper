<?php

namespace PrimitiveSocial\NestioApiWrapper;

use Nestio;

class NestioException extends \Exception {

	public static function noApiKey() {

		return new self("An API Key is required.");

	}

	public function missingListingId() {

		return new self('Missing listing ID');

	}

	public static function guzzleError($error, $request, $body, $url) {

		return new self(
			'Guzzle error: ' . $error . PHP_EOL .
			'Request: ' . $request . PHP_EOL . 
			'URL: ' . $url . PHP_EOL .
			'Send Data: ' . json_encode($body)
		);

	}

}