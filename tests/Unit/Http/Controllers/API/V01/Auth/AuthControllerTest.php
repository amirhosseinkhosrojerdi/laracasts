<?php

namespace Tests\Unit\Http\Controllers\API\V01\Auth;

// use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic unit test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $this->assertTrue(true);
    // }

    public function test_register_validate_user()
    {
        $response = $this->postJson('api/v1/auth/register');
        $response->assertStatus(422);
    }

    public function test_register_new_user()
    {
        $response = $this->postJson('api/v1/auth/register', [
            'name' => "Amirhossein",
            'email' => "amirhosseinkhosrojerdi9@gmail.com",
            'password' => "123456",
        ]);
        $response->assertStatus(201);
    }
}
