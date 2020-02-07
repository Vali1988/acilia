<?php


namespace App\Service\Product;


interface ProductPriceCalculateServiceInterface
{
	function calculatePrice(array $data, string $currency);
}