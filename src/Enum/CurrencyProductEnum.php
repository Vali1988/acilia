<?php


namespace App\Enum;


class CurrencyProductEnum
{
	private static $types = [
		'Euro' => 'EUR',
		'Dolar' => 'USD',
	];

	public static function getValues(){
		return self::$types;
	}
}