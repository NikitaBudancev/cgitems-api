<?php

namespace App\Policies;

use App\Enums\Permissions\ActionPermission;
use App\Models\Media;
use App\Models\User;

class MediaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(ActionPermission::createProject->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Media $media): bool
    {
        return $media->model->project->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(ActionPermission::createProject->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Media $media): bool
    {
        return $media->model->project->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Media $media): bool
    {
        return $media->model->project->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Media $media): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Media $media): bool
    {
        //
    }
}
