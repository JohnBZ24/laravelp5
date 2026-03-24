<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isManager();
    }

    public function view(User $user, User $model): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        if ($user->isManager()) {
            return $user->company_id === $model->company_id;
        }

        return $user->id === $model->id;
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isManager();
    }

    public function update(User $user, User $model): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        if ($user->isManager()) {
            return $user->company_id === $model->company_id;
        }

        return $user->id === $model->id;
    }

    public function delete(User $user, User $model): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        if ($user->isManager()) {
            return $user->company_id === $model->company_id && $model->role !== User::ROLE_SUPER_ADMIN;
        }

        return false;
    }

    public function restore(User $user, User $model): bool
    {
        return $user->isSuperAdmin();
    }

    public function forceDelete(User $user, User $model): bool
    {
        return $user->isSuperAdmin();
    }
}
