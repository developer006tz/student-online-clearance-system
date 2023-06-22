<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Clearance;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClearancePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the clearance can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list clearances');
    }

    /**
     * Determine whether the clearance can view the model.
     */
    public function view(User $user, Clearance $model): bool
    {
        return $user->hasPermissionTo('view clearances');
    }

    /**
     * Determine whether the clearance can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create clearances');
    }

    /**
     * Determine whether the clearance can update the model.
     */
    public function update(User $user, Clearance $model): bool
    {
        return $user->hasPermissionTo('update clearances');
    }

    /**
     * Determine whether the clearance can delete the model.
     */
    public function delete(User $user, Clearance $model): bool
    {
        return $user->hasPermissionTo('delete clearances');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete clearances');
    }

    /**
     * Determine whether the clearance can restore the model.
     */
    public function restore(User $user, Clearance $model): bool
    {
        return false;
    }

    /**
     * Determine whether the clearance can permanently delete the model.
     */
    public function forceDelete(User $user, Clearance $model): bool
    {
        return false;
    }
}
