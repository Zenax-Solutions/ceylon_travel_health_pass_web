<?php

namespace App\Policies;

use App\Models\User;
use App\Models\EsimService;
use Illuminate\Auth\Access\HandlesAuthorization;

class EsimServicePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the esimService can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the esimService can view the model.
     */
    public function view(User $user, EsimService $model): bool
    {
        return true;
    }

    /**
     * Determine whether the esimService can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the esimService can update the model.
     */
    public function update(User $user, EsimService $model): bool
    {
        return true;
    }

    /**
     * Determine whether the esimService can delete the model.
     */
    public function delete(User $user, EsimService $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the esimService can restore the model.
     */
    public function restore(User $user, EsimService $model): bool
    {
        return false;
    }

    /**
     * Determine whether the esimService can permanently delete the model.
     */
    public function forceDelete(User $user, EsimService $model): bool
    {
        return false;
    }
}
