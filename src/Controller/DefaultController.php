<?php

namespace LocalGovernmentBundle\Controller;

use LocalGovernmentBundle\Citizen\CitizenRepository;
use LocalGovernmentBundle\Property\PropertyRepository;
use Ramsey\Uuid\Uuid;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

	/** @var CitizenRepository */
	private $citizenRepository;

	/** @var PropertyRepository */
	private $propertyRepository;

	public function __construct(
		CitizenRepository $citizenRepository,
		PropertyRepository $propertyRepository
	)
	{
		$this->citizenRepository = $citizenRepository;
		$this->propertyRepository = $propertyRepository;
	}

	/**
	 * @Route("/", name="homepage")
	 */
	public function indexAction(Request $request)
	{
		$data = [];
		// $data = $this->citizenRepository->getCitizen(Uuid::fromString('d6f6a52c-6d3b-4ca9-ae50-4e9d955023b0'));
		//		$data['property'] = $property = $this->propertyRepository
		//			->getPropertyWithOwners(Uuid::fromString('3c8a6789-fe61-4ae4-8322-2553e2f507a1'));
		//		$data['address'] = $property->getAddress();
		//		$property->getAddress()->getCity(); // inicializaci
		//		foreach ($property->getOwners() as $owner) {
		//			$data['owners'][] = $owner;
		//			$owner->getOwner()->getName(); // inicializaci
		//		}

		$data['properties'] = $properties = $this->propertyRepository->getPropertiesWithOwners(0);
		$data['page'] = $properties->getPage();
		$data['perPage'] = $properties->getPerPage();
		$data['totalResults'] = $properties->getTotalResults();

		foreach ($properties as $property) {
			$property->getAddress();
			$property->getAddress()->getCity(); // inicializaci
			foreach ($property->getOwners() as $owner) {
				$owner->getOwner()->getName(); // inicializaci
			}
		}

		return $this->render('default/index.html.twig', [
			'data' => $data,
		]);
	}

}
