<?php

declare(strict_types = 1);

namespace LocalGovernmentBundle\Property\Residency;

use Doctrine\Common\Annotations\Annotation\Enum;
use Doctrine\ORM\Mapping as ORM;
use LocalGovernmentBundle\Citizen\Citizen;
use LocalGovernmentBundle\Property\Property;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */
class PropertyResidency
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
	private $resident;

	/**
	 * @ORM\ManyToOne(targetEntity=Property::class)
	 * @var Property
	 */
	private $property;

	/**
	 * @Enum(value=PropertyResidencyType::class)
	 * @ORM\Column(type="string_enum")
	 * @var PropertyResidencyType
	 */
	private $type;

	public function __construct(Citizen $resident, Property $property, PropertyResidencyType $type)
	{
		$this->id = Uuid::uuid4();
		$this->resident = $resident;
		$this->property = $property;
		$this->type = $type;
	}

	public function getId(): Uuid
	{
		return $this->id;
	}

	public function getResident(): Citizen
	{
		return $this->resident;
	}

	public function getProperty(): Property
	{
		return $this->property;
	}

	public function getType(): PropertyResidencyType
	{
		return $this->type;
	}

}
