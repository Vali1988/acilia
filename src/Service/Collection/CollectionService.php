<?php


namespace App\Service\Collection;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class CollectionService implements CollectionServiceInterface
{
	private $entityManager;

	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	public function collection(string $entityClass, Request $request)
	{
		$repo = $this->entityManager->getRepository($entityClass);
		$count = $repo->countTotal($request->query->get('filter', []));
		$result = $repo->findResult($request->query->get('filter', []), $request->query->get('pagination', [0,25]));

		return ['count' => $count, 'result' => $result];
	}
}