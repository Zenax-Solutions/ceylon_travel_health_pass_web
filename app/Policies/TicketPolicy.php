<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the ticket can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the ticket can view the model.
     */
    public function view(User $user, Ticket $model): bool
    {
        return true;
    }

    /**
     * Determine whether the ticket can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the ticket can update the model.
     */
    public function update(User $user, Ticket $model): bool
    {
        return true;
    }

    /**
     * Determine whether the ticket can delete the model.
     */
    public function delete(User $user, Ticket $model): bool
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
     * Determine whether the ticket can restore the model.
     */
    public function restore(User $user, Ticket $model): bool
    {
        return false;
    }

    /**
     * Determine whether the ticket can permanently delete the model.
     */
    public function forceDelete(User $user, Ticket $model): bool
    {
        return false;
    }
}
