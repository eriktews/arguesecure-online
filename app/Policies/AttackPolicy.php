<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class AttackPolicy
{
    use HandlesAuthorization;

    public function show($user, $attack)
    {
        return $attack->tree->public || ( $user->id == $attack->tree->user_id );
    }

    public function edit($user, $attack)
    {
        return $attack->tree->public || ( $user->id == $attack->tree->user_id );
    }

    public function append($user, $attack)
    {
        return $attack->tree->public || ( $user->id == $attack->tree->user_id );
    }

    public function update($user, $attack)
    {
        return $attack->tree->public || ( $user->id == $attack->tree->user_id );
    }

    public function destroy($user, $attack)
    {
        return $attack->tree->public || ( $user->id == $attack->tree->user_id );
    }
}
