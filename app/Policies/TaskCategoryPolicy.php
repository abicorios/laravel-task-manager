<?php

namespace App\Policies;

use App\Models\TaskCategory;
use App\Models\User;

class TaskCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TaskCategory $taskCategory): bool
    {
        return $user->isAdmin() || $user->id === $taskCategory->user_id || $taskCategory->type === 'standard';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TaskCategory $taskCategory): bool
    {
        return ($user->isAdmin() || $user->id === $taskCategory->user_id) && $taskCategory->type !== 'standard';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TaskCategory $taskCategory): bool
    {
        return $user->isAdmin() && $taskCategory->type !== 'standard';
    }
}
