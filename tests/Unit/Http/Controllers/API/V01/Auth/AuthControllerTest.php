<?php

namespace Tests\Unit\Http\Controllers\API\V01\Auth;

// use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }


    /**
     * Test Register
     */
    public function test_register_validate_user()
    {
        // $response = $this->postJson('api/v1/auth/register');
        $response = $this->postJson(route('auth.register'));
        $response->assertStatus(422);
    }

    public function test_register_new_user()
    {
        // $response = $this->postJson('api/v1/auth/register');
        $response = $this->postJson(route('auth.register'), [
            'name' => "Amirhossein",
            'email' => "amirhosseinkhosrojerdi9@gmail.com",
            'password' => "123456",
        ]);
        $response->assertStatus(201);
    }

    /**
     * Test Login
     */
    public function test_login_validate_user()
    {
        // $response = $this->postJson('api/v1/auth/login');
        $response = $this->postJson(route('auth.login'));
        $response->assertStatus(422);
    }

    public function test_login_user()
    {
        $user = User::factory(User::class)->create();

        // $response = $this->postJson('api/v1/auth/login');
        $response = $this->postJson(route('auth.login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response->assertStatus(200);
    }

    /**
     * Test Logged In User
     */
    public function test_show_user_info_if_logged_in()
    {
        $user = User::factory(User::class)->create();

        // $response = $this->postJson('api/v1/auth/user');
        $response = $this->actingAs($user)->get(route('auth.user'));
        $response->assertStatus(200);
    }

    /**
     * Test Logout
     */
    public function test_logout_user()
    {
        $user = User::factory(User::class)->create();

        // $response = $this->postJson('api/v1/auth/logout');
        $response = $this->actingAs($user)->postJson(route('auth.logout'));
        $response->assertStatus(200);
    }
}
