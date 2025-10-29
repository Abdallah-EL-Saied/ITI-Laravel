<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    // Admin can view any, Manager can view all categories, Client cannot
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'manager']);
    }

    // Admin can view, Manager can view, Client cannot
    public function view(User $user, Category $category): bool
    {
        return in_array($user->role, ['admin', 'manager']);
    }

    // Only admin can create
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    // Only admin can update
    public function update(User $user, Category $category): bool
    {
        return $user->role === 'admin';
    }

    // Only admin can delete
    public function delete(User $user, Category $category): bool
    {
        return $user->role === 'admin';
    }

    // Only admin can restore
    public function restore(User $user, Category $category): bool
    {
        return $user->role === 'admin';
    }

    // Only admin can force delete
    public function forceDelete(User $user, Category $category): bool
    {
        return $user->role === 'admin';
    }
}
