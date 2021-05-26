<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CurrencyRateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_successful_request()
    {
        $response = $this->post('/currency_rate', [
            'source_currency' => 'USD',
            'target_currency' => 'EUR',
            'amount' => '100',
        ]);
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_required_fields()
    {
        $response = $this->post('/currency_rate', []);
        $response->assertSessionHasErrors(['source_currency', 'target_currency', 'amount']);
    }

    /**
     * @return void
     */
    public function test_such_source_currency_does_not_exist()
    {
        $response = $this->post('/currency_rate', [
            'source_currency' => 'XXX',
            'target_currency' => 'EUR',
            'amount' => '100',
        ]);
        $response->assertStatus(403);
    }

    /**
     * @return void
     */
    public function test_such_target_currency_does_not_exist()
    {
        $response = $this->post('/currency_rate', [
            'source_currency' => 'USD',
            'target_currency' => 'XXX',
            'amount' => '100',
        ]);
        $response->assertStatus(403);
    }
}
