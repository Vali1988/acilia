<?php


namespace App\DataFixtures;


use App\Entity\Category;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends BaseFixtures
{

	protected function loadData(ObjectManager $objectManager)
	{
		$this->createMany(Category::class, 10, function(Category $category) {
			$category->setName($this->faker->realText(50))
				->setDescription($this->faker->realText(150));
		});

		$objectManager->flush();
	}
}