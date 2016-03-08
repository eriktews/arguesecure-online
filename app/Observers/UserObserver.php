<?php namespace App\Observers;

use App\Events\TreeEvents;

class UserObserver extends BaseObserver
{

    public function saving($model) 
    {
        //
    }

    public function deleting($user)
    {
        
        foreach ($user->trees as $tree)
        {
            $tree->delete();
        }
    }

}