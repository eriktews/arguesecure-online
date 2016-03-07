<?php namespace App\Observers;

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

        $model->tags()->sync([]);
    }

    /**
     * Check if user is authenticated
     */
    protected function isAuth()
    {
        if ( ! auth()->check() ) return abort('403');
    }

    /**
     * Check if Model is owned by the currently authenticated user
     */
    protected function modelIsOwnedByUser($model)
    {
        if ( Schema::hasColumn($model->getTable(), 'user_id') && $model->user && ( auth()->user()->id !== $model->user->id) ) return abort('403');
    }
	
}