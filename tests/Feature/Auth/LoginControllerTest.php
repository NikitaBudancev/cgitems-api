<?php

namespace Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_correct_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'test@mail.com',
            'password' => bcrypt($password = 'test'),
        ]);

        $response = $this->postJson(route('login'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        // Проверка успешного ответа
        $response->assertStatus(200)
            ->assertJsonStructure([
                'result' => [

                ],
            ]);
    }

    public function test_user_cannot_login_with_incorrect_password(): void
    {
        // Создание пользователя для теста
        $user = User::factory()->create([
            'password' => bcrypt('correct-password'),
        ]);

        // Отправка запроса на вход в систему с неправильным паролем
        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        // Проверка, что возвращается ошибка 422
        $response->assertStatus(422)
            ->assertJson([
                'message' => 'error_login',
            ]);
    }
}
