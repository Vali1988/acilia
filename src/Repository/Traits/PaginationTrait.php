<?php


namespace App\Repository\Traits;


use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\QueryBuilder;

trait PaginationTrait
{
	/** @var QueryBuilder */
	protected $qb;

	public function countTotal(array $filter = [])
	{
		$this->qb	= $this->createQueryBuilder('c');
		$this->qb->select('count(1)')
			->setMaxResults(1);
		$this->applyFilter($filter);
		return $this->qb->getQuery()->getSingleScalarResult();
	}

	public function findResult(array $filter = [], array $pagination = [])
	{
		$this->qb	= $this->createQueryBuilder('c');
		$this->applyPagination($pagination);
		$this->applyFilter($filter);
		return $this->qb->getQuery()->getResult();
	}

	private function applyPagination(array $pagination)
	{
		if(count($pagination)) {
			$firstResult = $pagination[0];
			$lastResult = $pagination[1];

			$this->qb->setFirstResult($firstResult);

			if (!is_null($lastResult)) {
				$maxResults = $lastResult - $firstResult + 1;
				$this->qb->setMaxResults($maxResults);
			}
		}
	}

	private function applyFilter(array $filter)
	{
		/** @var ClassMetadata $entityMetaData */
		$entityMetaData = $this->getEntityManager()->getClassMetadata($this->entity);
		foreach ($filter as $key => $value) {
			$path = explode('.', $key);
			$entity = 'c';
			$field = $path[0];
			$this->qb->andWhere(sprintf("%s.%s = :filter_%s", $entity, $field, $field));
			$this->qb->setParameter("filter_" . $field, $value);
		}
	}
}