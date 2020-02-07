<?php


namespace App\Tests\Categories;


use App\Entity\Category;
use App\Tests\Base;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryTest extends Base
{
	function testGetItemCategorySuccess()
	{
		$id = $this->findOneIdBy(Category::class, 'name', 'category 1');
		$request = $this->request(Request::METHOD_GET, '/categories/'.$id);
		$this->assertEquals(Response::HTTP_OK, $request->getStatusCode());
	}

	function testGetItemCategoryFailed()
	{
		$request = $this->request(Request::METHOD_GET, '/categories/85');
		$this->assertEquals(Response::HTTP_NOT_FOUND, $request->getStatusCode());
	}

	function testGetCollectionCategory()
	{
		$request = $this->request(Request::METHOD_GET, '/categories');
		$this->assertEquals(Response::HTTP_OK, $request->getStatusCode());
	}

	function testDeleteCategorySuccess()
	{
		$id = $this->findOneIdBy(Category::class, 'name', 'category 1');
		$request = $this->request(Request::METHOD_DELETE, '/categories/'.$id);
		$this->assertEquals(Response::HTTP_NO_CONTENT, $request->getStatusCode());
	}

	function testDeleteCategoryFailed()
	{
		$request = $this->request(Request::METHOD_GET, '/categories/85');
		$this->assertEquals(Response::HTTP_NOT_FOUND, $request->getStatusCode());
	}

	function testCreateCategorySuccess()
	{
		$request = $this->request(Request::METHOD_POST, '/categories', [
			'name' => 'Test Name Success',
			"description" => 'Test Description'
		]);
		$this->assertEquals(Response::HTTP_CREATED, $request->getStatusCode());
	}

	function testCreateCategoryFailed()
	{
		$request = $this->request(Request::METHOD_POST, '/categories', [
			"description" => 'Test Description'
		]);
		$this->assertEquals(Response::HTTP_BAD_REQUEST, $request->getStatusCode());
	}

	function testUpdateCategorySuccess()
	{
		$id = $this->findOneIdBy(Category::class, 'name', 'category 1');
		$request = $this->request(Request::METHOD_PUT, '/categories/'.$id, [
			'name' => 'Test Name Update',
			'description' => 'Test description Update'
		]);
		$this->assertEquals(Response::HTTP_OK, $request->getStatusCode());

		$request = $this->request(Request::METHOD_PATCH, '/categories/'.$id, [
			'description' => 'Test description Update'
		]);
		$this->assertEquals(Response::HTTP_OK, $request->getStatusCode());
	}

	function testUpdateCategoryFailed()
	{
		$request = $this->request(Request::METHOD_PATCH, '/categories/800', [
			'description' => 'Test description Update'
		]);
		$this->assertEquals(Response::HTTP_NOT_FOUND, $request->getStatusCode());
	}
}