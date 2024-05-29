<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DiscountService;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscountServicePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the discountService can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the discountService can view the model.
     */
    public function view(User $user, DiscountService $model): bool
    {
        return true;
    }

    /**
     * Determine whether the discountService can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the discountService can update the model.
     */
    public function update(User $user, DiscountService $model): bool
    {
        return true;
    }

    /**
     * Determine whether the discountService can delete the model.
     */
    public function delete(User $user, DiscountService $model): bool
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
     * Determine whether the discountService can restore the model.
     */
    public function restore(User $user, DiscountService $model): bool
    {
        return false;
    }

    /**
     * Determine whether the discountService can permanently delete the model.
     */
    public function forceDelete(User $user, DiscountService $model): bool
    {
        return false;
    }
}
