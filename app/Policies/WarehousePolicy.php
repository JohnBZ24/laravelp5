<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Warehouse;

class WarehousePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isManager() || $user->isEmployee();
    }

    public function view(User $user, Warehouse $warehouse): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return $user->company_id === $warehouse->company_id;
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isManager();
    }

    public function update(User $user, Warehouse $warehouse): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        if ($user->isManager()) {
            return $user->company_id === $warehouse->company_id;
        }

        return false;
    }

    public function delete(User $user, Warehouse $warehouse): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        if ($user->isManager()) {
            return $user->company_id === $warehouse->company_id;
        }

        return false;
    }

    public function restore(User $user, Warehouse $warehouse): bool
    {
        return $user->isSuperAdmin();
    }

    public function forceDelete(User $user, Warehouse $warehouse): bool
    {
        return $user->isSuperAdmin();
    }
}
