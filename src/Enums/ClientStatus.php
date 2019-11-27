<?php

namespace PrimitiveSocial\NestioApiWrapper\Enums;

use PrimitiveSocial\NestioApiWrapper\Enums\Enum;

class ClientStatus extends Enum {

	const LEAD = 'lead';

	const TOURED = 'toured';

	const APPLICANT = 'applicant';

	const RESIDENT = 'resident';

	const NOTAPROSPECT = 'not-a-prospect';
}