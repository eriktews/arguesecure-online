<?php namespace App\Observers;

use Auth;
use Schema;

abstract class BaseObserver 
{

	public function creating($model)
    {
        //
    }

    public function created($model)
    {
        //
    }

    public function updating($model)
    {
        //
    }

    /**
     * Only Authenticated users are allowed to save a model
     */
    public function saving($model) 
    {
        $this->isAuth();
    }

    public function saved($model)
    {
        //
    }

    public function deleting($model)
    {        
        $this->isAuth();
        $this->modelIsOwnedByUser($model);
    }

    /**
     * Check if user is authenticated
     */
    protected function isAuth()
    {
        if ( !Auth::check() ) return abort('401');
    }

    /**
     * Check if Model is owned by the currently authenticated user
     */
    protected function modelIsOwnedByUser($model)
    {
        if ( Schema::hasColumn($model->getTable(), 'user_id') && $model->user && (Auth::user()->id !== $model->user->id) ) return abort('401');
    }
	
}