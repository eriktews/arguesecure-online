<?php namespace App\Observers;

use Auth;

use App\Events\TreeEvents;

class TreeObserver extends BaseObserver
{

	public function creating($tree)
    {
        parent::creating($tree);

        $tree->user_id = Auth::user()->id;
    }

    public function created($tree)
    {
        parent::created($tree);
        
        event(new TreeEvents\TreeCreated($tree));
    }

    public function updating($tree)
    {
        parent::updating($tree);
    }

    public function saving($tree)
    {
        parent::saving($tree);

        $tree->updatedBy()->associate(Auth::user()->id);
    }

    public function saved($tree)
    {
        parent::saved($tree);

        event(new TreeEvents\TreeSaved($tree));
    }

    public function deleting($tree)
    {
        parent::deleting($tree);

        foreach($tree->risks as $risk)
        {
            $risk->delete();
        }

        event(new TreeEvents\TreeDeleted($tree));
    }


	
}