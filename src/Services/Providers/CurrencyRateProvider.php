<?php
namespace Services\Providers;

abstract class CurrencyRateProvider
{
	public $ratesProviderUrl;

	public function __construct(string $ratesProviderUrl)
	{
		$this->ratesProviderUrl = $ratesProviderUrl;
	}

	abstract function getExchangeRateByCurrency(string $currency);

	public function decodeExchangeRateResponse()
	{
		return @json_decode(file_get_contents($this->ratesProviderUrl), true);
	}
}