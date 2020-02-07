<?php


namespace App\Service\Product;


use App\Entity\Product;
use Symfony\Component\HttpFoundation\Request;

interface ProductServiceInterface
{
	function create($entity);
	function collection(Request $request);
}