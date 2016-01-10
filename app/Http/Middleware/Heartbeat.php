<?php

namespace App\Http\Middleware;

use Closure;

use Cache;

class Heartbeat
{

    private $namespace = '\App';

    private $lockable = ['Tree'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {        
        $hearttick = Cache::get('hearttick');

        $time_between_requests = env('HEARTRATE', 15); //in seconds;

        if ($hearttick == null || 0 + $hearttick + $time_between_requests < time() )
        {
            if ($request->has('arsec_update_type') && $request->has('arsec_update_id') && in_array($request->input('arsec_update_type'), $this->lockable))
            {
                $this->updateLock( $request->input('arsec_update_type'), $request->input('arsec_update_id') );
            }

            array_walk($this->lockable, [$this, 'unlockModel']);

            //update hearttick
            Cache::put('hearttick', time(), 30);
        }

        return $next($request);
    }

    private function updateLock($modelClass, $id)
    {
        $modelClass = new \ReflectionClass($this->namespace.'\\'.$request->input('type')); //TO ADD if in lockable 

        if ( $modelClass->hasMethod('lock') )
        {
            $modelInstance = $modelClass->newInstance();
            $model = $modelInstance->withoutGlobalScopes()->findOrFail($id);

            if ($model->user_id != auth()->user()->id) // can be replaced with policies and gates
            {
                return response()->json('Tsk tsk tsk', 403);
            }

            $model->lock();
            $model->save();
        }
    }

    private function unlockModel($modelClass)
    {
        $modelClass = new \ReflectionClass($this->namespace.'\\'.$modelClass);
        if ( $modelClass->hasMethod('unlock') )
        {
            $modelInstance = $modelClass->newInstance();
            $models = $modelInstance->withoutGlobalScopes()->where('locked','=',1)->where('lock_time','<',time())->get();

            foreach ($models as $model) 
            {
                $model->unlock();
                $model->save();
            }
        }
    }


}
