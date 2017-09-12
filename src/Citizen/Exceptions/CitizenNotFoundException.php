<?php

declare(strict_types = 1);

namespace LocalGovernmentBundle\Citizen\Exceptions;

use Ramsey\Uuid\Uuid;

class CitizenNotFoundException extends \Exception
{

	/** @var Uuid */
	private $citizenId;

	public function __construct(Uuid $citizenId, ?\Throwable $e)
	{
		parent::__construct(sprintf('Citizen %s not found', $citizenId->toString()), 0, $e);
		$this->citizenId = $citizenId;
	}

	public function getCitizenId(): Uuid
	{
		return $this->citizenId;
	}

}
