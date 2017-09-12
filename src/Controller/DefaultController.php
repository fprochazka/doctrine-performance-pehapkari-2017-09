<?php

namespace LocalGovernmentBundle\Controller;

use LocalGovernmentBundle\Citizen\CitizenRepository;
use Ramsey\Uuid\Uuid;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

	/** @var CitizenRepository */
	private $citizenRepository;

	public function __construct(
		CitizenRepository $citizenRepository
	)
	{
		$this->citizenRepository = $citizenRepository;
	}

	/**
	 * @Route("/", name="homepage")
	 */
	public function indexAction(Request $request)
	{
		// replace this example code with whatever you need
		return $this->render('default/index.html.twig', [
			'data' => $this->citizenRepository->getCitizen(Uuid::fromString('d6f6a52c-6d3b-4ca9-ae50-4e9d955023b0')),
		]);
	}

}
