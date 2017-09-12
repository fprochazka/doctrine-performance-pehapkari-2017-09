<?php

declare(strict_types = 1);

namespace LocalGovernmentBundle\Doctrine;

use Traversable;

class ResultSet implements \IteratorAggregate
{

	/** @var array */
	private $data;

	/** @var int */
	private $page;

	/** @var int */
	private $perPage;

	/** @var int */
	private $totalResults;

	public function __construct(
		array $data,
		int $page,
		int $perPage,
		int $totalResults
	)
	{
		$this->data = $data;
		$this->page = $page;
		$this->perPage = $perPage;
		$this->totalResults = $totalResults;
	}

	public function getIterator()
	{
		return new \ArrayIterator($this->data);
	}

	public function getPage(): int
	{
		return $this->page;
	}

	public function getPerPage(): int
	{
		return $this->perPage;
	}

	public function getTotalResults(): int
	{
		return $this->totalResults;
	}

}
