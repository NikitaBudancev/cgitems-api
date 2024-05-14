<?php

namespace App\DTO\Users;

use App\DTO\CoreDto;

class RegisterUserDto extends CoreDto
{
    public string $firstName;

    public string $lastName;

    public string $nickname;

    public string $email;

    public string $password;
}
