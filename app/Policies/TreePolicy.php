<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class TreePolicy
{
    use HandlesAuthorization;

    public function show($user, $tree)
    {
        return $tree->public || ( !$tree->public && ( $user->id == $tree->user_id ) );
    }

    public function edit($user, $tree)
    {
        return $user->id == $tree->user_id;
    }

    public function update($user, $tree)
    {
        return $user->id == $tree->user_id;
    }

    public function destroy($user, $tree)
    {
        return $user->id == $tree->user_id;
    }
}
