<?php

namespace Tests\Unit;

use App\Models\Subscription;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_store_subscription(): void
    {
        $login = $this->json('POST', '/api/login', [
            'email' => 'test@test.com',
            'password' => 'test',
        ]);
        $loginData = $login->getOriginalContent();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$loginData['token'],
        ])->post('/api/user/1/subscription', [
            'renewed_at' => now(),
            'expired_at' => now()->addMonth(),
        ]);

        $response->assertStatus(201);
    }

    public function test_update_subscription(): void
    {
        $subscription = Subscription::first(); // Varsayılan abonelik

        $login = $this->json('POST', '/api/login', [
            'email' => 'test@test.com',
            'password' => 'test',
        ]);
        $loginData = $login->getOriginalContent();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$loginData['token'],
        ])->put('/api/user/1/subscription/'.$subscription->id, [
            'renewed_at' => now(),
            'expired_at' => now()->addMonth(),
        ]);

        $response->assertStatus(201);
    }

    public function test_delete_subscription(): void
    {
        $login = $this->json('POST', '/api/login', [
            'email' => 'test@test.com',
            'password' => 'test',
        ]);
        $loginData = $login->getOriginalContent();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$loginData['token'],
        ])->delete('/api/user/1/subscription', []);

        $response->assertStatus(204);
    }
}
