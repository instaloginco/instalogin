<?php

namespace App\Facades\Currency;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CurrencyException extends \Exception {}

class Currency
{
    /**
     * Get the rate between $sourceCurrency and $targetCurrency
     *
     * @param $sourceCurrency
     * @param $targetCurrency
     * @return float
     * @throws CurrencyException
     */
    public static function rate($sourceCurrency, $targetCurrency): float
    {
        $rates = Cache::remember('rates' . '_' . $sourceCurrency, 60 * 60, function () use ($sourceCurrency) {
            return Http::get(sprintf('https://openexchangerates.org/api/latest.json?app_id=%s&base=%s',
                env('CURRENCY_RATE_API'), $sourceCurrency))->json();
        });

        # In case API returns an error, throw an exception
        if (isset($rates['status']) && $rates['status'] != 200) {
            throw new CurrencyException($rates['description']);
        };

        # If targetCurrency exists in the returned list, return it, otherwise throw an exception
        if (isset($rates['rates'][$targetCurrency])) {
            return $rates['rates'][$targetCurrency];
        } else {
            throw new CurrencyException('Such target currency does not exist');
        }
    }

    /**
     * Return list of currencies
     *
     * @return mixed
     */
    public static function getAllCurrencies(): mixed
    {
        // @todo store in database in db migrations
        return Cache::remember('currencies', 60 * 60 * 24, function () {
            return Http::get('https://openexchangerates.org/api/currencies.json')->json();
        });
    }
}
