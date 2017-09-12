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
			$dql = 'SELECT citizen, mother
				FROM \LocalGovernmentBundle\Citizen\Citizen citizen
				LEFT JOIN citizen.mother mother
				WHERE citizen.id = :citizenId';

			return $this->entityManager
				->createQuery($dql)
				->setParameter('citizenId', $citizenId)
				->getSingleResult();

		} catch (\Doctrine\ORM\NoResultException $e) {
			throw new \LocalGovernmentBundle\Citizen\Exceptions\CitizenNotFoundException($citizenId, $e);
		}
	}

}
