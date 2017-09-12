<?php

declare(strict_types = 1);

namespace LocalGovernmentBundle\Property;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */
class PropertyAddress
{

	/**
	 * @ORM\Id()
	 * @ORM\Column(type="uuid")
	 * @var \Ramsey\Uuid\Uuid
	 */
	private $id;

	/**
	 * @ORM\Column()
	 * @var string
	 */
	private $city;

	/**
	 * @ORM\Column()
	 * @var string
	 */
	private $street;

	/**
	 * @ORM\Column(type="integer")
	 * @var int
	 */
	private $houseNumber;

	/**
	 * @ORM\Column(type="integer")
	 * @var int
	 */
	private $postalCode;

	public function __construct(string $city, string $street, int $houseNumber, int $postalCode)
	{
		$this->id = Uuid::uuid4();
		$this->city = $city;
		$this->street = $street;
		$this->houseNumber = $houseNumber;
		$this->postalCode = $postalCode;
	}

	public function getId(): Uuid
	{
		return $this->id;
	}

	public function getCity(): string
	{
		return $this->city;
	}

	public function getStreet(): string
	{
		return $this->street;
	}

	public function getHouseNumber(): int
	{
		return $this->houseNumber;
	}

	public function getPostalCode(): int
	{
		return $this->postalCode;
	}

}
