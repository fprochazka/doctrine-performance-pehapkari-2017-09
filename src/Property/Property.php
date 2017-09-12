<?php

declare(strict_types = 1);

namespace LocalGovernmentBundle\Property;

use Doctrine\Common\Annotations\Annotation\Enum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Kdyby\Doctrine\Collections\Readonly\ReadOnlyCollectionWrapper;
use LocalGovernmentBundle\Citizen\Citizen;
use LocalGovernmentBundle\Property\Ownership\PropertyOwnership;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */
class Property
{

	/**
	 * @ORM\Id()
	 * @ORM\Column(type="uuid")
	 * @var \Ramsey\Uuid\Uuid
	 */
	private $id;

	/**
	 * @Enum(value=PropertyType::class)
	 * @ORM\Column(type="string_enum")
	 * @var PropertyType
	 */
	private $type;

	/**
	 * @ORM\ManyToOne(targetEntity=PropertyAddress::class)
	 * @ORM\JoinColumn(nullable=false)
	 * @var PropertyAddress
	 */
	private $address;

	/**
	 * @ORM\OneToMany(targetEntity=PropertyOwnership::class, mappedBy="property")
	 * @var PropertyOwnership[]|Collection
	 */
	private $owners;

	/**
	 * @param Citizen[] $owners
	 */
	public function __construct(PropertyType $type, PropertyAddress $address, array $owners)
	{
		$this->id = Uuid::uuid4();
		$this->type = $type;
		$this->address = $address;
		$this->setOwners($owners);
	}

	public function getId(): Uuid
	{
		return $this->id;
	}

	public function getType(): PropertyType
	{
		return $this->type;
	}

	public function getAddress(): PropertyAddress
	{
		return $this->address;
	}

	private function setOwners(array $owners): void
	{
		$this->owners = new ArrayCollection();
		foreach ($owners as $owner) {
			if (!$owner instanceof PropertyOwnership) {
				throw new \InvalidArgumentException();
			}

			$this->owners->add($owner);
		}
	}

	/**
	 * @return PropertyOwnership[]|Collection
	 */
	public function getOwners(): Collection
	{
		return new ReadOnlyCollectionWrapper($this->owners);
	}

}
