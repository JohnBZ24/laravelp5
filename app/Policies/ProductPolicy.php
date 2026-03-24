<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isManager() || $user->isEmployee();
    }

    public function view(User $user, Product $product): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return $user->company_id === $product->warehouse->company_id;
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isManager();
    }

    public function update(User $user, Product $product): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        if ($user->isManager()) {
            return $user->company_id === $product->warehouse->company_id;
        }

        return false;
    }

    public function delete(User $user, Product $product): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        if ($user->isManager()) {
            return $user->company_id === $product->warehouse->company_id;
        }

        return false;
    }

    public function restore(User $user, Product $product): bool
    {
        return $user->isSuperAdmin();
    }

    public function forceDelete(User $user, Product $product): bool
    {
        return $user->isSuperAdmin();
    }
}
