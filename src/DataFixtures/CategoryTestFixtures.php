<?php


namespace App\DataFixtures;


use App\Entity\Category;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryTestFixtures extends BaseFixtures
{
	protected function loadData(ObjectManager $objectManager)
	{
		$category = $this->createCategory('category 1');
		$objectManager->persist($category);
		$this->addReference('category_1', $category);

		$category = $this->createCategory('category 2');
		$objectManager->persist($category);
		$this->addReference('category_2', $category);

		$objectManager->flush();
	}

	private function createCategory(string $name)
	{
		$category = new Category();
		$category->setName($name)
			->setDescription($this->faker->text);
		return $category;
	}
}