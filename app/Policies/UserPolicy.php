<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    //编辑权限
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    //删除权限
    public function destroy(User $currentUser, User $user)
    {
        return $currentUser->is_admin && $currentUser->id !== $user->id;
    }

    //关注的授权策略（自己不能关注自己）
    public function follow(User $currentUser, User $user)
    {
        return $currentUser->id !== $user->id;
    }
}
