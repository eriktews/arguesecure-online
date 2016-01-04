<?php namespace App\Observers;

use Auth;

use App\Events\TreeEvents;

class UserObserver extends BaseObserver
{

	public function creating($tree)
    {
        //
    }

    public function updating($tree)
    {
        //
    }

    public function saving($tree)
    {
       //
    }

    public function saved($tree)
    {
        //
    }

    public function deleting($tree)
    {
        parent::deleting($tree);

        //Add Tree removal
    }


	
}