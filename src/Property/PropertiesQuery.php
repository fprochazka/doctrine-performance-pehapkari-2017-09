<?php

declare(strict_types = 1);

namespace LocalGovernmentBundle\Property;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use LocalGovernmentBundle\Doctrine\QueryObject;

class PropertiesQuery extends QueryObject
{

	public function __construct()
	{
		parent::__construct(Property::class, 'property');
	}

	public function filterByType(PropertyType $type)
	{
		$this->filter[] = function (QueryBuilder $qb) {
			$qb->andWhere("property.type = :propertyType")
				->setParameter('propertyType', $type);
		};
	}

	public function withOwners()
	{
		$this->onPostFetch[] = function (EntityManager $em, \Iterator $iterator) {
			$ids = array_keys(iterator_to_array($iterator, TRUE));

			$ownersQuery = 'SELECT partial property.{id}, propertyOwners, propertyOwner
				FROM \LocalGovernmentBundle\Property\Property property
				LEFT JOIN property.owners propertyOwners
				LEFT JOIN propertyOwners.owner propertyOwner
				WHERE  property.id IN (:propertyIds)';

			$em->createQuery($ownersQuery)
				->setParameter('propertyIds', $ids)
				->setFetchMode(PropertyOwnership::class, 'owner', ClassMetadata::FETCH_EAGER)
				->getResult();
		};
	}

}
