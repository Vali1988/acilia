<?php


namespace App\DataFixtures;


use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixtures extends BaseFixture implements DependentFixtureInterface
{
	private $currency = [
		'USD',
		'EUR',
	];

	protected function loadData(ObjectManager $objectManager)
	{
		$this->createMany(Product::class, 25, function(Product $product) {
			$product->setName($this->faker->realText(50))
				->setPrice($this->faker->randomFloat(2, 1, 50))
				->setFeatured($this->faker->boolean(40))
				->setCurrency($this->faker->randomElement($this->currency));

			if($this->faker->boolean()) {
				$product->setCategory($this->getRandomReference(Category::class));
			}

		});

		$objectManager->flush();
	}

	public function getDependencies()
	{
		return [
			CategoryFixtures::class,
		];
	}
}