<?php namespace App\Observers;

use Auth;

use App\Events\TreeEvents\TreeUpdated;

class TreeObserver extends BaseObserver
{

	public function creating($tree)
    {
        $tree->user_id = Auth::user()->id;
    }

    public function updating($tree)
    {
        //
    }

    public function saving($tree)
    {
        parent::saving($tree);

        $tree->updatedBy()->associate(Auth::user()->id);
    }

    public function saved($tree)
    {
        event(new TreeUpdated($tree));
    }
	
}