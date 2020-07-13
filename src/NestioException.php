<?php

namespace PrimitiveSocial\NestioApiWrapper;

use Nestio;

class NestioException extends \Exception {

	public static function noApiKey() {

		return new self("An API Key is required.");

	}

	public static function missingListingId() {

		return new self('Missing listing ID');

	}

	public static function clientMissingPerson() {

		return new self('Client is missing person');

	}

	public static function clientMissingPersonFirstName() {

		return new self('Client is missing person\'s first name');

	}

	public static function clientMissingPersonLastName() {

		return new self('Client is missing person\'s last name');

	}

	public static function clientMissingGroup() {

		return new self('Client is missing group');

	}

	public static function missingClientId() {

		return new self('Client is missing Nestio Client Id');

	}

	public static function clientMissingStatus() {

		return new self('Client is missing status for status update request');

	}

	public static function guzzleError($error, $request, $body, $url) {

		return new self(
			'Guzzle error: ' . $error . PHP_EOL .
			'Request: ' . $request . PHP_EOL . 
			'URL: ' . $url . PHP_EOL .
			'Send Data: ' . json_encode($body)
		);

	}

    public static function error($error) {

        return new self(
            $error . PHP_EOL
        );

    }

}