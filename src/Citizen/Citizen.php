<?php

declare(strict_types = 1);

namespace LocalGovernmentBundle\Citizen;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */
class Citizen
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
	private $name;

	/**
	 * @ORM\Column(type="datetime_immutable")
	 * @var \DateTimeImmutable
	 */
	private $birthDate;

	/**
	 * @ORM\ManyToOne(targetEntity=Citizen::class)
	 * @var Citizen
	 */
	private $mother;

	/**
	 * @ORM\ManyToOne(targetEntity=Citizen::class)
	 * @var Citizen
	 */
	private $father;

	public function __construct(string $name, \DateTimeImmutable $birthDate, Citizen $mother, Citizen $father)
	{
		$this->id = Uuid::uuid4();
		$this->name = $name;
		$this->birthDate = $birthDate;
		$this->mother = $mother;
		$this->father = $father;
	}

	public function getId(): Uuid
	{
		return $this->id;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getBirthDate(): \DateTimeImmutable
	{
		return $this->birthDate;
	}

	public function getMother(): Citizen
	{
		return $this->mother;
	}

	public function getFather(): Citizen
	{
		return $this->father;
	}

}
