<?php

use PHPUnit\Framework\TestCase;
use Services\ExchangeRateApiService;

class ExchangeRateServiceTest extends TestCase
{
	const CURRENCY = 'PHP';
	const ECHANGE_RATE_URL = 'https://api.exchangeratesapi.io/latest';

    public function testGetExchangeRateByCurrencyIsFloat()
	{
		$exchangeRate = new ExchangeRateApiService(self::ECHANGE_RATE_URL);
		$fixAmount = $exchangeRate->getExchangeRateByCurrency(self::CURRENCY);

		$this->assertTrue(is_float($fixAmount));
	}

    public function testGetExchangeRateByCurrencyThrowException()
	{
		$exchangeRate = new ExchangeRateApiService(self::ECHANGE_RATE_URL);

		$this->expectException("Exception");
		$this->expectExceptionMessage("Invalid currency");

		$fixAmount = $exchangeRate->getExchangeRateByCurrency('Anything');
	}
}