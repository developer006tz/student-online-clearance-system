<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Clear;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClearPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the clear can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list clears');
    }

    /**
     * Determine whether the clear can view the model.
     */
    public function view(User $user, Clear $model): bool
    {
        return $user->hasPermissionTo('view clears');
    }

    /**
     * Determine whether the clear can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create clears');
    }

    /**
     * Determine whether the clear can update the model.
     */
    public function update(User $user, Clear $model): bool
    {
        return $user->hasPermissionTo('update clears');
    }

    /**
     * Determine whether the clear can delete the model.
     */
    public function delete(User $user, Clear $model): bool
    {
        return $user->hasPermissionTo('delete clears');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete clears');
    }

    /**
     * Determine whether the clear can restore the model.
     */
    public function restore(User $user, Clear $model): bool
    {
        return false;
    }

    /**
     * Determine whether the clear can permanently delete the model.
     */
    public function forceDelete(User $user, Clear $model): bool
    {
        return false;
    }
}
