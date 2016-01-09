<?php namespace App\Observers;

use App\Events\TreeEvents;

class TreeObserver extends BaseObserver
{

	public function creating($tree)
    {
        parent::creating($tree);

        $tree->user_id = auth()->user()->id;
    }

    public function created($tree)
    {
        parent::created($tree);

        if ($tree->public)
            event(new TreeEvents\TreeCreated($tree));
    }

    public function updating($tree)
    {
        parent::updating($tree);
    }

    public function saving($tree)
    {
        parent::saving($tree);

        $tree->updatedBy()->associate(auth()->user()->id);

        $tree->lock = time();
    }

    public function saved($tree)
    {
        parent::saved($tree);

        //If public or was public
        if ( $tree->getOriginal('public',0) || $tree->public)
            event(new TreeEvents\TreeSaved($tree));
    }

    public function deleting($tree)
    {
        parent::deleting($tree);

        foreach($tree->risks as $risk)
        {
            $risk->delete();
        }        

        if ($tree->public)
            event(new TreeEvents\TreeDeleted($tree));        
    }


	
}