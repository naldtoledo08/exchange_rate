<?php
namespace Services;

use Services\ExchangeRateApiService;

class BinService
{
	// private $exchangeRate;

	// public function __construct(ExchangeRate $exchangeRate){
	// 	$this->$exchangeRate = $exchangeRate;
	// }

	const BIN_LIST_LOOKUP_URL = 'https://lookup.binlist.net/';
	const ECHANGE_RATE_URL = 'https://api.exchangeratesapi.io/latest';

    public function getBinInformation(string $binNumber)
	{
		$data = file_get_contents(self::BIN_LIST_LOOKUP_URL . $binNumber);

		if (!$data)
	    	die('error!');

	    return json_decode($data); 
	}

	public function getFixAmount(string $currency, float $amount): float
	{
		$exchangeRate = new ExchangeRateApiService(self::ECHANGE_RATE_URL);

		$rate = $currency == 'EUR' ? 0 : $exchangeRate->getExchangeRateByCurrency($currency);

		if ($currency == 'EUR' ||  $rate == 0) {
	        return $amount;
	    }

	    return $amount / $rate;
	}

	public function isEuropeCountry(string $countryCode): bool
	{
	    $europeCountryCode = [
	    	'AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK', 'EE', 'ES', 'FI', 
			'FR', 'GR', 'HR', 'HU', 'IE', 'IT', 'LT', 'LU', 'LV', 'MT', 
			'NL', 'PO', 'PT', 'RO', 'SE', 'SI', 
		];

	    if (in_array($countryCode, $europeCountryCode)) {
	    	return true;
	    }
	    
	    return false;
	}

	public function getCommission(float $amount, string $countryCode): float
	{
		return round($amount * ($this->isEuropeCountry($countryCode) ? 0.01 : 0.02), 2);
	}

}