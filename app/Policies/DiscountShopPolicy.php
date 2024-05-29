<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DiscountShop;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscountShopPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the discountShop can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the discountShop can view the model.
     */
    public function view(User $user, DiscountShop $model): bool
    {
        return true;
    }

    /**
     * Determine whether the discountShop can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the discountShop can update the model.
     */
    public function update(User $user, DiscountShop $model): bool
    {
        return true;
    }

    /**
     * Determine whether the discountShop can delete the model.
     */
    public function delete(User $user, DiscountShop $model): bool
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
     * Determine whether the discountShop can restore the model.
     */
    public function restore(User $user, DiscountShop $model): bool
    {
        return false;
    }

    /**
     * Determine whether the discountShop can permanently delete the model.
     */
    public function forceDelete(User $user, DiscountShop $model): bool
    {
        return false;
    }
}
