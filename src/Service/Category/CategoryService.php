<?php


namespace App\Service\Category;

use App\Entity\Category;
use App\Service\BaseActionService;
use Doctrine\ORM\EntityManagerInterface;

class CategoryService extends BaseActionService implements CategoryServiceInterface
{
	protected $entityClass = Category::class;
}