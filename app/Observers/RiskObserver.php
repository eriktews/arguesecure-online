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
        if (!$risk->is_deletable) {
            return false;
        }

        parent::deleting($risk);

        event(new RiskEvents\RiskDeleted($risk));
    }


	
}