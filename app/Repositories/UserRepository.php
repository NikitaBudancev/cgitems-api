<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepositoryContract;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository extends CoreRepository implements UserRepositoryContract
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    protected array $defaultColumns = [
        'id',
        'first_name',
        'last_name',
        'email',
        'nickname',
    ];

    protected array $defaultWith = [
        'info',
        'role',
        'avatar',
    ];

    public function getAllWithPaginate(int $perPage, ?int $page = null): LengthAwarePaginator
    {
        $conditions = [['published', '=', true]];

        return $this->paginate($perPage, page: $page, conditions: $conditions);
    }
}
