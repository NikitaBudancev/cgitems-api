<?php

namespace App\Repositories;

use App\Contracts\Repositories\ProjectRepositoryContract;
use App\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProjectRepository extends CoreRepository implements ProjectRepositoryContract
{
    public function __construct(Project $model)
    {
        parent::__construct($model);
    }

    public function getProject($id): ?Model
    {
        return $this->findWithColumns($id);
    }

    public function getWithRelations($id): ?Model
    {
        //        $with = ProjectEnum::getAllWithRelations();

        return $this->findWithColumns($id);
    }

    public function getProjectBySlug(string $slug): ?Model
    {
        //        $with = ProjectEnum::getAllWithRelations();
        //        $columns = ProjectEnum::getAllColumns();

        return $this->findBySlug($slug);
    }

    public function getPublishedProjectBySlug(string $slug): ?Model
    {
        //                $with = ProjectEnum::getAllWithRelations();
        //                $columns = ProjectEnum::getAllColumns();
        $conditions = [['published', '=', true]];

        return $this->findBySlug($slug, conditions: $conditions);
    }

    public function getAllWithPaginate(int $perPage, ?int $page = null): ?LengthAwarePaginator
    {
        $conditions = [['published', '=', true]];

        return $this->paginate($perPage, page: $page, conditions: $conditions);
    }

    public function getAllUserProjects(int $userId): Collection
    {
        return $this->createQuery()
            ->where('user_id', $userId)
            ->get();
    }

    public function getPublishedUserProjects($userId): Collection
    {
        return $this->createQuery()
            ->where('user_id', $userId)
            ->where('published', true)
            ->with('stage', 'stage.preview')
            ->get();
    }

    public function getPublishedUserProject($userId, $slug): ?Model
    {
        $with = ['stages', 'stages.images', 'stages.preview', 'stages.property', 'user.avatar'];

        return $this->createQuery()
            ->with($with)
            ->where('slug', $slug)
            ->where('user_id', $userId)
            ->where('published', true)
            ->firstOrFail();
    }

    public function getReviewsByUserId(int $id): Collection
    {
        return $this
            ->createQuery()
            ->where('user_id', '=', $id)
            ->where('review', '<>', '')
            ->get();
    }
}
