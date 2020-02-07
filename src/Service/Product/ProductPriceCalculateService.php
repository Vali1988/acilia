<?php


namespace App\Service\Product;


use App\Entity\Product;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request;

class ProductPriceCalculateService implements ProductPriceCalculateServiceInterface
{
	function calculatePrice(array $data, string $currency)
	{
		/** @var Product  $product */
		foreach ($data as $key => $product) {
			if($currency != $product->getCurrency()) {
				$currencyConversion = $this->getCurrencyConversion($currency);
				$price = round($product->getPrice() * $currencyConversion, 2);
				$product->setPrice($price)
					->setCurrency($currency);
			}
		}
	}

	private function getCurrencyConversion(string $currency)
	{
		$client = new Client(['http_errors' => false]);
		$parameters = $this->getParameters($currency);
		$url = 'https://api.exchangeratesapi.io/latest?base='.$parameters['base'] . '&symbols='.$parameters['symbol'];
		$response = $client->request(Request::METHOD_GET, $url);
		$data = json_decode($response->getBody()->getContents(), true);

		return $data['rates'][$currency];
	}

	private function getParameters(string $currency)
	{
		return [
			'symbol' => ($currency == 'EUR') ? 'EUR' : 'USD',
			'base' => ($currency == 'EUR') ? 'USD' : 'EUR'
		];
	}
}