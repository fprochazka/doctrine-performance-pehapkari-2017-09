<?php

declare(strict_types = 1);

namespace LocalGovernmentBundle\Property\Exceptions;

use Ramsey\Uuid\Uuid;

class PropertyNotFoundException extends \Exception
{

	/** @var Uuid */
	private $propertyId;

	public function __construct(Uuid $propertyId, ?\Throwable $e)
	{
		parent::__construct(sprintf('Property %s not found', $propertyId->toString()), 0, $e);
		$this->propertyId = $propertyId;
	}

	public function getPropertyId(): Uuid
	{
		return $this->propertyId;
	}

}
