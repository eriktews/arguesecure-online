<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class RiskPolicy
{
    use HandlesAuthorization;

    public function show($user, $risk)
    {
        return $risk->tree->public || ( $user->id == $risk->tree->user_id );
    }

    public function edit($user, $risk)
    {
        return $risk->tree->public || ( $user->id == $risk->tree->user_id );
    }

    public function append($user, $risk)
    {
        return $risk->tree->public || ( $user->id == $risk->tree->user_id );
    }

    public function update($user, $risk)
    {
        return $risk->tree->public || ( $user->id == $risk->tree->user_id );
    }

    public function destroy($user, $risk)
    {
        return $risk->tree->public || ( $user->id == $risk->tree->user_id );
    }
}
