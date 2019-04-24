<?php

namespace PrimitiveSocial\NestioApiWrapper;

use Nestio;

class NestioException extends \Exception {

	public static function noApiUrl() {

		return new self("An API URL is required.");

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