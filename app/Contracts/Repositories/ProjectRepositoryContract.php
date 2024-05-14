<?php

namespace App\Contracts\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ProjectRepositoryContract
{
    public function getProject($id): ?Model;

    public function getWithRelations($id): ?Model;

    public function getProjectBySlug(string $slug): ?Model;

    public function getPublishedProjectBySlug(string $slug): ?Model;

    public function getAllWithPaginate(int $perPage, ?int $page = null): ?LengthAwarePaginator;

    public function getAllUserProjects(int $userId): Collection;

    public function getPublishedUserProjects($userId): Collection;

    public function getReviewsByUserId(int $id): Collection;

    public function getPublishedUserProject($userId, $slug): ?Model;
}
