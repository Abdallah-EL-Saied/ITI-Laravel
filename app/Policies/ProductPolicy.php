<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    // Admin and Manager can view products
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'manager']);
    }

    // Admin can view any, Manager only their own, Client only products
    public function view(User $user, Product $product): bool
    {
        if ($user->role === 'admin')
            return true;
        if ($user->role === 'manager')
            return $product->user_id === $user->id;
        return $user->role === 'client';
    }

    // Admin and Manager can create (manager limited by middleware)
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'manager']);
    }

    // Admin can update any, Manager only their own
    public function update(User $user, Product $product): bool
    {
        if ($user->role === 'admin')
            return true;
        if ($user->role === 'manager')
            return $product->user_id === $user->id;
        return false;
    }

    // Admin can delete any, Manager only their own
    public function delete(User $user, Product $product): bool
    {
        if ($user->role === 'admin')
            return true;
        if ($user->role === 'manager')
            return $product->user_id === $user->id;
        return false;
    }

    // Admin can restore any, Manager only their own
    public function restore(User $user, Product $product): bool
    {
        if ($user->role === 'admin')
            return true;
        if ($user->role === 'manager')
            return $product->user_id === $user->id;
        return false;
    }

    // Only admin can force delete
    public function forceDelete(User $user, Product $product): bool
    {
        return $user->role === 'admin';
    }
}
