<?php namespace App\Observers;

use App\Events\DefenceEvents;

class DefenceObserver extends BaseObserver
{

	public function creating($defence)
    {
        parent::creating($defence);
    }

    public function created($defence)
    {
        parent::created($defence);
    }

    public function updating($defence)
    {
        parent::updating($defence);
    }

    public function saving($defence)
    {
        parent::saving($defence);

        $defence->updatedBy()->associate(auth()->user()->id);
    }

    public function saved($defence)
    {
        parent::saved($defence);

        event(new DefenceEvents\DefenceSaved($defence));
    }

    public function deleting($defence)
    {
        parent::deleting($defence);

        event(new DefenceEvents\DefenceDeleted($defence));
    }
	
}