<?php


namespace App\Controller\Api;


use App\Controller\BaseController;
use App\Entity\Product;
use App\Form\Product\ProductFormType;
use App\Service\Product\ProductServiceInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProductController
 * @package App\Controller\Api
 */
class ProductController extends BaseController
{
	protected $formPost = ProductFormType::class;
	protected $formUpdate = ProductFormType::class;
	protected $entityClass = Product::class;
	protected $groupCollection = 'product:collection';
	protected $groupItem = 'product:item';
	protected $groupCreate = 'product:create';
	protected $groupUpdate = 'product:update';

	public function __construct(ProductServiceInterface $service)
	{
		$this->service = $service;
	}

	/**
	 * @Rest\Post("/products")
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function create(Request $request)
	{
		return parent::create($request);
	}

	/**
	 * @Rest\Put("/products/{id}")
	 * @param Request $request
	 * @param Product $entity
	 * @param integer $id
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function put(Request $request, Product $entity, int $id)
	{
		return parent::update($request, $entity, Request::METHOD_PUT);
	}

	/**
	 * @Rest\Patch("/products/{id}")
	 * @param Request $request
	 * @param Product $entity
	 * @param integer $id
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function patch(Request $request, Product $entity, int $id)
	{
		return parent::update($request, $entity, Request::METHOD_PUT);
	}

	/**
	 * @Rest\Delete("/products/{id}")
	 * @param Product $entity
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function remove(Product $entity)
	{
		return parent::delete($entity);
	}

	/**
	 * @Rest\Get("/products")
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function collection(Request $request)
	{
		return parent::collection($request);
	}

	/**
	 * @Rest\Get("/products/{id}")
	 * @param Product $entity
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function element(Product $entity)
	{
		return parent::item($entity);
	}

	/**
	 * @Rest\Get("/product/featured")
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function featured(Request $request)
	{
		$request->query->set('filter', ['featured' => true]);
		return parent::collection($request);
	}
}