<?php

declare(strict_types = 1);

namespace LocalGovernmentBundle\Citizen;

use Doctrine\ORM\EntityManager;
use Ramsey\Uuid\Uuid;

class CitizenRepository
{

	/** @var EntityManager */
	private $entityManager;

	public function __construct(
		EntityManager $entityManager
	)
	{
		$this->entityManager = $entityManager;
	}

	/**
	 * @throws Exceptions\CitizenNotFoundException
	 * @throws \Doctrine\ORM\NonUniqueResultException
	 */
	public function getCitizen(Uuid $citizenId): Citizen
	{
		try {
			return $this->entityManager
				->createQuery('SELECT citizen FROM \LocalGovernmentBundle\Citizen\Citizen citizen WHERE citizen.id = :citizenId')
				->setParameter('citizenId', $citizenId)
				->getSingleResult();

		} catch (\Doctrine\ORM\NoResultException $e) {
			throw new \LocalGovernmentBundle\Citizen\Exceptions\CitizenNotFoundException($citizenId, $e);
		}
	}


}
