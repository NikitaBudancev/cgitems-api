<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class CoreRepository
{
    protected array $defaultColumns = ['*'];

    protected array $defaultWith = [];

    public function __construct(
        protected Model $model
    ) {
    }

    protected function createQuery(): Builder
    {
        return clone $this->model->query();
    }

    protected function find($id): ?Model
    {
        return $this->createQuery()->findOrFail($id);
    }

    protected function findWithColumns(int $id, ?array $columns = null, ?array $with = null): ?Model
    {
        return $this->createQuery()
            ->select($columns ?? $this->defaultColumns)
            ->with($with ?? $this->defaultWith)
            ->findOrFail($id);
    }

    protected function findBySlug(
        string $slug,
        ?array $columns = null,
        ?array $with = null,
        ?array $conditions = [],
        ?string $columnName = 'slug'
    ): ?Model {
        $query = $this->createQuery();
        $conditions[] = [$columnName, '=', $slug];

        foreach ($conditions as $condition) {
            $query->where(...$condition);
        }

        return $query->select($columns ?? $this->defaultColumns)
            ->with($with ?? $this->defaultWith)
            ->firstOrFail();
    }

    protected function all(?array $columns = null, ?array $with = null): ?Collection
    {
        return $this->createQuery()
            ->with($with ?? $this->defaultWith)
            ->get($columns ?? $this->defaultColumns);
    }

    protected function paginate(
        ?int $perPage = null,
        ?array $columns = null,
        string $pageName = 'page',
        ?int $page = null,
        ?array $with = null,
        array $conditions = [],
        array $orderBy = []
    ): ?LengthAwarePaginator {
        $query = $this
            ->createQuery()
            ->with($with ?? $this->defaultWith);

        foreach ($conditions as $condition) {
            $query->where(...$condition);
        }

        foreach ($orderBy as $field => $direction) {
            $query->orderBy($field, $direction);
        }

        return $query->paginate($perPage, $columns ?? $this->defaultColumns, $pageName, $page);
    }
}
