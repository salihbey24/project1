<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_get_user(): void
    {
        $login = $this->json('POST', '/api/login', [
            'email' => 'test@test.com',
            'password' => 'test',
        ]);
        $loginData = $login->getOriginalContent();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$loginData['token'],
        ])->get('/api/user/1', []);

        $response->assertJsonStructure([
            'id',
            'subscriptions',
            'transactions',
        ]);
        $response->assertStatus(200);
    }
}
