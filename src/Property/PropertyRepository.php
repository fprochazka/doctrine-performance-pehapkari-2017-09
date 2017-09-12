<?php

declare(strict_types = 1);

namespace LocalGovernmentBundle\Property;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Tools\Pagination\Paginator;
use LocalGovernmentBundle\Doctrine\ResultSet;
use LocalGovernmentBundle\Property\Ownership\PropertyOwnership;
use Ramsey\Uuid\Uuid;

class PropertyRepository
{

	/** @var EntityManager */
	private $entityManager;

	public function __construct(
		EntityManager $entityManager
	)
	{
		$this->entityManager = $entityManager;
	}

	public function getPropertyWithOwners(Uuid $propertyId): Property
	{
		try {
			$qo = new PropertiesQuery();
			$qo->filterById($propertyId);
			$qo->withAddress();
			$qo->withOwners();
			return $this->neco->fetchOne($qo);

			$propertyQuery = 'SELECT property, propertyAddress
				FROM \LocalGovernmentBundle\Property\Property property
				LEFT JOIN property.address propertyAddress
				WHERE property.id = :propertyId';
			$property = $this->entityManager
				->createQuery($propertyQuery)
				->setParameter('propertyId', $propertyId->toString())
				->getSingleResult();

			$ownersQuery = 'SELECT partial property.{id}, propertyOwners
				FROM \LocalGovernmentBundle\Property\Property property
				LEFT JOIN property.owners propertyOwners
				WHERE  property.id = :propertyId';
			$this->entityManager
				->createQuery($ownersQuery)
				->setParameter('propertyId', $propertyId->toString())
				->setFetchMode(PropertyOwnership::class, 'owner', ClassMetadata::FETCH_EAGER)
				->getResult();

			return $property;

		} catch (NoResultException $e) {
			throw new \LocalGovernmentBundle\Property\Exceptions\PropertyNotFoundException($propertyId, $e);
		}
	}

	/**
	 * @return Property[]|ResultSet
	 */
	public function getPropertiesWithOwners(int $page): ResultSet
	{
		$qo = new PropertiesQuery();
		$qo->filterByType(PropertyType::get(PropertyType::HOME));
		$qo->withAddress();
		$qo->withOwners();

		return $this->neco->fetch($qo); // return new ResultSet($properties->getArrayCopy(), $page, 100, $paginatedProperties->count());

//
//		$propertyQuery = 'SELECT property, propertyAddress
//			FROM \LocalGovernmentBundle\Property\Property property
//			LEFT JOIN property.address propertyAddress ';
//		/** @var Property[]|\ArrayIterator $properties */
//		$propertiesQuery = $this->entityManager
//			->createQuery($propertyQuery)
//			->setMaxResults(100)
//			->setFirstResult($page);
//		$paginatedProperties = new Paginator($propertiesQuery, false);
//		$properties = $paginatedProperties->getIterator();

//		$ids = [];
//		foreach ($properties as $property) {
//			$ids[] = $property->getId();
//		}
//
//		$ownersQuery = 'SELECT partial property.{id}, propertyOwners, propertyOwner
//			FROM \LocalGovernmentBundle\Property\Property property
//			LEFT JOIN property.owners propertyOwners
//			LEFT JOIN propertyOwners.owner propertyOwner
//			WHERE  property.id IN (:propertyIds)';
//		$this->entityManager
//			->createQuery($ownersQuery)
//			->setParameter('propertyIds', $ids)
//			->setFetchMode(PropertyOwnership::class, 'owner', ClassMetadata::FETCH_EAGER)
//			->getResult();
	}

}
