<?php


namespace App\Service\Product;

use App\Entity\Product;
use App\Service\BaseActionService;
use App\Service\Collection\CollectionServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ProductService extends BaseActionService implements ProductServiceInterface
{
	protected $entityClass = Product::class;
	private $productPriceCalculateService;

	public function __construct(EntityManagerInterface $entityManager, CollectionServiceInterface $collectionService, ProductPriceCalculateServiceInterface $productPriceCalculateService)
	{
		parent::__construct($entityManager, $collectionService);
		$this->productPriceCalculateService = $productPriceCalculateService;
	}

	public function collection(Request $request)
	{
		$currency = $request->query->get('currency', '');
		$request->query->remove('currency');
		$data = parent::collection($request);
		if($currency && in_array($currency, ['EUR', 'USD'])) {
			$this->productPriceCalculateService->calculatePrice($data['result'], $currency);
		}

		return $data;
	}
}