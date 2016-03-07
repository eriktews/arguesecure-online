<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class DefencePolicy
{
    use HandlesAuthorization;

    public function show($user, $defence)
    {
        return $defence->tree->public || ( $user->id == $defence->tree->user_id );
    }

    public function edit($user, $defence)
    {
        return $defence->tree->public || ( $user->id == $defence->tree->user_id );
    }

    public function append($user, $defence)
    {
        return $defence->tree->public || ( $user->id == $defence->tree->user_id );
    }

    public function update($user, $defence)
    {
        return $defence->tree->public || ( $user->id == $defence->tree->user_id );
    }

    public function destroy($user, $defence)
    {
        return $defence->tree->public || ( $user->id == $defence->tree->user_id );
    }
}
