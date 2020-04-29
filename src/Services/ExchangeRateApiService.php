<?php
namespace Services;

use Services\Providers\CurrencyRateProvider;
use http\Exception\InvalidArgumentException;

class ExchangeRateApiService extends CurrencyRateProvider
{

	public function getExchangeRateByCurrency(string $currency): float
	{
		$response = $this->decodeExchangeRateResponse($currency);

		if(!isset($response['rates']) || !isset($response['rates'][$currency])){
			throw new \Exception("Invalid currency", 100);
		}

		return $response['rates'][$currency];
	}
}