<?php

namespace Feature\Auth;

use App\Models\UserColor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {

        Role::create(['name' => 'user']);

        UserColor::create([
            'name' => 'Оранжевый',
            'color' => '#E3AE00',
        ]);

        $userData = [
            'firstName' => 'test',
            'lastName' => 'test',
            'nickname' => 'test',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->postJson(route('register'), $userData);

        $response->assertStatus(ResponseAlias::HTTP_CREATED)
            ->assertJson([
                'result' => [
                    'id' => 1,
                    'firstName' => 'test',
                    'lastName' => 'test',
                    'nickname' => 'test',
                    'role' => 'user',
                    'verified' => false,
                    'info' => [

                    ],
                ],
                'status' => 201,
                'success' => true,
            ]);

        $this->assertDatabaseHas('users', [
            'email' => $userData['email'],
        ]);

        $this->assertAuthenticated();

    }

    public function test_user_cannot_register_with_invalid_data()
    {

        $response = $this->postJson(route('register'), [
            'firstName' => 'test',
            'lastName' => 'test',
            'nickname' => 'test',
            'email' => 'not-an-email',
            'password' => '123',
            'password_confirmation' => '123',
        ]);

        $response->assertStatus(ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertDatabaseMissing('users', [
            'email' => 'not-an-email',
        ]);
    }
}
