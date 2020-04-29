<?php
use PHPUnit\Framework\TestCase;
use Services\BinService;

class BinServiceTest extends TestCase
{
	const BIN_NUMBER = '4745030';
	const CURRENCY = 'PHP';
	const AMOUNT = 50.00;
	const EU_COUNTRY_CODE = 'DE';

    public function testGetBinInformationHasCountryAttribute()
	{
		$binService = new BinService();
		$object = $binService->getBinInformation(self::BIN_NUMBER);

		$this->assertObjectHasAttribute('country', $object);
	}

	public function testGetFixAmountIsFloat()
	{
		$binService = new BinService();
		$result = $binService->getFixAmount(self::CURRENCY, self::AMOUNT);

		$this->assertTrue(is_float($result));
	}

	public function testIsEuropeCountryIsTrue()
	{
		$binService = new BinService();
		$result = $binService->isEuropeCountry(self::EU_COUNTRY_CODE);

	    $this->assertTrue($result);
	}

	public function testIsEuropeCountryIsFalse()
	{
		$binService = new BinService();
		$result = $binService->isEuropeCountry('PH');
	    $this->assertFalse($result);
	}

	public function testGetCommissionIsFloat()
	{
		$binService = new BinService();
		$result = $binService->getCommission(self::AMOUNT, self::EU_COUNTRY_CODE);
		$this->assertTrue(is_float($result));
	}
}