<?php


namespace App\Tests\Product;

use App\Entity\Product;
use App\Tests\Base;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductTest extends Base
{
	function testGetItemProductSuccess()
	{
		$id = $this->findOneIdBy(Product::class, 'name', 'product 1');
		$request = $this->request(Request::METHOD_GET, '/products/'.$id);
		$this->assertEquals(Response::HTTP_OK, $request->getStatusCode());
	}

	function testGetItemProductFailed()
	{
		$request = $this->request(Request::METHOD_GET, '/products/85');
		$this->assertEquals(Response::HTTP_NOT_FOUND, $request->getStatusCode());
	}

	function testCollectionProductSuccess()
	{
		$request = $this->request(Request::METHOD_GET, '/products');
		$this->assertEquals(Response::HTTP_OK, $request->getStatusCode());
	}

	function testDeleteProductSuccess()
	{
		$id = $this->findOneIdBy(Product::class, 'name', 'product 1');
		$request = $this->request(Request::METHOD_DELETE, '/products/'.$id);

		$this->assertEquals(Response::HTTP_NO_CONTENT, $request->getStatusCode());
	}

	function testDeleteProductFailed()
	{
		$request = $this->request(Request::METHOD_DELETE, '/products/56');
		$this->assertEquals(Response::HTTP_NOT_FOUND, $request->getStatusCode());
	}

	function testUpdateProductSuccess()
	{
		$id = $this->findOneIdBy(Product::class, 'name', 'product 1');
		$request = $this->request(Request::METHOD_PATCH, '/products/' . $id, [
			'name' => 'Test Name Success'
		]);
		$this->assertEquals(Response::HTTP_OK, $request->getStatusCode());
	}

	function testUpdateProductFailed()
	{
		$request = $this->request(Request::METHOD_PATCH, '/products/56');
		$this->assertEquals(Response::HTTP_NOT_FOUND, $request->getStatusCode());
	}

	function testCreateProductSuccess()
	{
		$request = $this->request(Request::METHOD_POST, '/products', [
			'name' => 'Test Name Success',
			"price" => 4.3,
			"currency" => "EUR",
		]);
		$this->assertEquals(Response::HTTP_CREATED, $request->getStatusCode());
	}

	function testCreateProductFailed()
	{
		$request = $this->request(Request::METHOD_POST, '/products', [
			'name' => 'Test Name Success'
		]);

		$this->assertEquals(Response::HTTP_BAD_REQUEST, $request->getStatusCode());
	}
}