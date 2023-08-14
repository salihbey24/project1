<?php

namespace Tests\Unit;

use App\Models\Subscription;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_store_transaction(): void
    {
        $subscription = Subscription::first(); // Varsayılan abonelik

        $login = $this->json('POST', '/api/login', [
            'email' => 'test@test.com',
            'password' => 'test',
        ]);
        $loginData = $login->getOriginalContent();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$loginData['token'],
        ])->post('/api/user/1/transaction', [
            'subscription_id' => $subscription->id,
            'price' => '555',
        ]);

        $response->assertStatus(201);
    }
}
