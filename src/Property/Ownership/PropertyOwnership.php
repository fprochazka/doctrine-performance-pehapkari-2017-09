<?php

declare(strict_types = 1);

namespace LocalGovernmentBundle\Property\Ownership;

use Doctrine\ORM\Mapping as ORM;
use LocalGovernmentBundle\Citizen\Citizen;
use LocalGovernmentBundle\Property\Property;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */
class PropertyOwnership
{

	/**
	 * @ORM\Id()
	 * @ORM\Column(type="uuid")
	 * @var \Ramsey\Uuid\Uuid
	 */
	private $id;

	/**
	 * @ORM\ManyToOne(targetEntity=Citizen::class)
	 * @var Citizen
	 */
	private $owner;

	/**
	 * @ORM\ManyToOne(targetEntity=Property::class, inversedBy="owners")
	 * @var Property
	 */
	private $property;

	public function __construct(Citizen $owner, Property $property)
	{
		$this->id = Uuid::uuid4();
		$this->owner = $owner;
		$this->property = $property;
	}

	public function getId(): Uuid
	{
		return $this->id;
	}

	public function getOwner(): Citizen
	{
		return $this->owner;
	}

	public function getProperty(): Property
	{
		return $this->property;
	}

}
