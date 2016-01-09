<?php namespace App\Observers;

use App\Events\RiskEvents;

class RiskObserver extends BaseObserver
{

	public function creating($risk)
    {
        parent::creating($risk);
    }

    public function created($risk)
    {
        parent::created($risk);
        
        event(new RiskEvents\RiskCreated($risk));
    }

    public function updating($risk)
    {
        parent::updating($risk);
    }

    public function saving($risk)
    {
        parent::saving($risk);

        $risk->updatedBy()->associate(auth()->user()->id);
    }

    public function saved($risk)
    {
        parent::saved($risk);

        event(new RiskEvents\RiskSaved($risk));
    }

    public function deleting($risk)
    {
        parent::deleting($risk);

        event(new RiskEvents\RiskDeleted($risk));
    }


	
}