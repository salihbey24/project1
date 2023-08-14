<?php

namespace Tests\Unit;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_register(): void
    {
        $response = $this->post('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_registerValidation(): void
    {
        $response = $this->post('/api/register', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(302);
    }
}
