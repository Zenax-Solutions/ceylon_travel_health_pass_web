<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Agent;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the agent can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the agent can view the model.
     */
    public function view(User $user, Agent $model): bool
    {
        return true;
    }

    /**
     * Determine whether the agent can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the agent can update the model.
     */
    public function update(User $user, Agent $model): bool
    {
        return true;
    }

    /**
     * Determine whether the agent can delete the model.
     */
    public function delete(User $user, Agent $model): bool
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
     * Determine whether the agent can restore the model.
     */
    public function restore(User $user, Agent $model): bool
    {
        return false;
    }

    /**
     * Determine whether the agent can permanently delete the model.
     */
    public function forceDelete(User $user, Agent $model): bool
    {
        return false;
    }
}
