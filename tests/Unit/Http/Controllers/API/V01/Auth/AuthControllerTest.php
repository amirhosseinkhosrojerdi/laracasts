<?php

namespace Tests\Unit\Http\Controllers\API\V01\Auth;

// use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

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
     * Test Register Should Be Validated
     */
    public function test_register_should_be_validated()
    {
        // $response = $this->postJson('api/v1/auth/register');
        $response = $this->postJson(route('auth.register'));
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test New User Can Registeer
     */
    public function test_new_user_can_register()
    {
        // $response = $this->postJson('api/v1/auth/register');
        $response = $this->postJson(route('auth.register'), [
            'name' => "Amirhossein",
            'email' => "amirhosseinkhosrojerdi9@gmail.com",
            'password' => "123456",
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    /**
     * Test Login Should Be Validated
     */
    public function test_login_should_be_validated()
    {
        // $response = $this->postJson('api/v1/auth/login');
        $response = $this->postJson(route('auth.login'));
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test User Can Login With True Credentials
     */
    public function test_user_can_login_with_true_credentials()
    {
        $user = User::factory(User::class)->create();

        // $response = $this->postJson('api/v1/auth/login');
        $response = $this->postJson(route('auth.login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test Show User Info If Logged In
     */
    public function test_show_user_info_if_logged_in()
    {
        $user = User::factory(User::class)->create();

        // $response = $this->postJson('api/v1/auth/user');
        $response = $this->actingAs($user)->get(route('auth.user'));
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test Logged In User Can Logout
     */
    public function test_logged_in_user_can_logout()
    {
        $user = User::factory(User::class)->create();

        // $response = $this->postJson('api/v1/auth/logout');
        $response = $this->actingAs($user)->postJson(route('auth.logout'));
        $response->assertStatus(Response::HTTP_OK);
    }
}
