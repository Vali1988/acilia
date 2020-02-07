<?php


namespace App\Enum;


class CurrencyProductEnum
{
	public static $types = [
		'Euro' => 'EUR',
		'Dolar' => 'USD',
	];

	public static function getValues(){
		return self::$types;
	}
}