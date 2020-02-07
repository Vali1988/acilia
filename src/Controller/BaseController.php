<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends AbstractFOSRestController
{
	protected $formPost;
	protected $formUpdate;
	protected $entity;
	protected $service;
	protected $entityClass;
	protected $groupCollection;
	protected $groupItem;
	protected $groupCreate;
	protected $groupUpdate;

	public function create(Request $request)
	{
		$form = $this->createForm($this->formPost);
		$form->submit(json_decode($request->getContent(), true));
		if($form->isValid()) {
			$entity = $form->getData();
			$this->service->create($entity);
			$view = $this->view($entity, 201);
		} else {
			$view = $this->view($form, 400);
		}

		$view->getContext()->enableMaxDepth()->setGroups([$this->groupCreate]);
		return $this->handleView($view);
	}

	public function update(Request $request, $entity, string $method = Request::METHOD_PATCH)
	{
		$form = $this->createForm($this->formUpdate, $entity, ['method' => $method]);
		$form->submit(json_decode($request->getContent(), true), false);
		if($form->isValid()) {
			$entity = $form->getData();
			$this->service->update($entity);
			$view = $this->view($entity, 200);
		} else {
			$view = $this->view($form, 400);
		}

		$view->getContext()->enableMaxDepth()->setGroups([$this->groupUpdate]);
		return $this->handleView($view);
	}

	public function delete($entity)
	{
		$this->service->delete($entity);
		return $this->handleView($this->view([], 204));
	}

	public function collection(Request $request)
	{
		$view = $this->view($this->service->collection($request),  Response::HTTP_OK);
		$view->getContext()->enableMaxDepth()->setGroups([$this->groupCollection]);
		return $this->handleView($view);
	}

	public function item($entity)
	{
		$view = $this->view($entity, Response::HTTP_OK);
		$view->getContext()->enableMaxDepth()->setGroups([$this->groupItem]);
		return $this->handleView($view);
	}
}