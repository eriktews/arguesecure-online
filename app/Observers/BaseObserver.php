<?php namespace App\Observers;

use Auth;

abstract class BaseObserver 
{

	public function creating($model)
    {
        //
    }

    public function updating($model)
    {
        //
    }

    public function saving($model) 
    {
        $this->checks();
    }

    public function saved($model)
    {
        //
    }

    protected function checks()
    {
        if ( !Auth::check() ) return abort('401');
    }
	
}