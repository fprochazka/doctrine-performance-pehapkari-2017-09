<?php

declare(strict_types = 1);

namespace LocalGovernmentBundle\Property\Residency;

use Consistence\Enum\Enum;

class PropertyResidencyType extends Enum
{

	const PERMANENT = 'permanent';
	const TEMPORARY = 'temporary';

}
