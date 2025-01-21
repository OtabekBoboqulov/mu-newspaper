<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function edit(User $user, User $editor): bool
    {
        return $editor->is($user);
    }

    public function admin(User $user)
    {
        return $user->status == 'admin' || $user->status == 'superadmin';
    }

    public function superadmin(User $user)
    {
        return $user->status == 'superadmin';
    }

}
