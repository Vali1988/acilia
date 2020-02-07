<?php


namespace App\Service;


use App\Service\Collection\CollectionServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class BaseActionService
{
	protected $entityManager;
	protected $entityClass;
	protected $collection;
	protected $collectionService;

	public function __construct(EntityManagerInterface $entityManager, CollectionServiceInterface $collectionService)
	{
		$this->entityManager = $entityManager;
		$this->collectionService = $collectionService;
	}

	function create($entity)
	{
		$this->entityManager->getRepository($this->entityClass)->add($entity);
	}

	function update($entity)
	{
		$this->entityManager->getRepository($this->entityClass)->add($entity);
	}

	function delete($entity)
	{
		$this->entityManager->getRepository($this->entityClass)->delete($entity);
	}

	function collection(Request $request)
	{
		return $this->collectionService->collection($this->entityClass, $request);
	}
}