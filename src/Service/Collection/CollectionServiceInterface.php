<?php


namespace App\Service\Collection;


use Symfony\Component\HttpFoundation\Request;

interface CollectionServiceInterface
{
	public function collection(string $entityClass, Request $request);
}