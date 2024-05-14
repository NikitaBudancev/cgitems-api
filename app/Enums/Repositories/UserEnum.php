<?php

namespace App\Enums\Repositories;

enum UserEnum: string
{
    case User = 'user:id,first_name,last_name,nickname';
    case UserAvatar = 'user.avatar';
    case UserInfo = 'user.info';
    case UserRole = 'user.role';
}
