<?php namespace App\Observers;

use App\Events\AttackEvents;

class AttackObserver extends BaseObserver
{

	public function creating($attack)
    {
        parent::creating($attack);
    }

    public function created($attack)
    {
        parent::created($attack);
    }

    public function updating($attack)
    {
        parent::updating($attack);
    }

    public function saving($attack)
    {
        parent::saving($attack);

        $attack->updatedBy()->associate(auth()->user()->id);
    }

    public function saved($attack)
    {
        parent::saved($attack);

        event(new AttackEvents\AttackSaved($attack));
    }

    public function deleting($attack)
    {
        parent::deleting($attack);

        event(new AttackEvents\AttackDeleted($attack));
    }
	
}