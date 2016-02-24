<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NodeController extends Controller
{

    private $namespace = '\App';

    /**
     * Retrieve the HTML for the tree visualisation
     * @param  Request $request 
     * @param  $node  A node
     * @return string           HTML 
     */
    public function nodeTreeVis(Request $request, $node)
    {
        if ( ! $request->ajax() ) return abort(400);

        return view('visualisation.leaf', [ 'node' => $node ])->render();
    }

    public function nodeStartUpdate(Request $request)
    {
        if ( ! $request->ajax() ) return abort(400);

        $type = $request->input('type');
        $id = $request->input('id');

        if ( ! class_exists($this->namespace.'\\'.$type) ) return response()->json('Tsk tsk tsk', 500);

        if (! ($type && $id) ) return response()->json('Tsk tsk tsk', 500);

        $modelClass = new \ReflectionClass($this->namespace.'\\'.$type);

        if ( ! $modelClass->hasMethod('lock') ) return response()->json('Tsk tsk tsk', 500);
    
        $modelInstance = $modelClass->newInstance();
        $model = $modelInstance->findOrFail($id);

        if (!auth()->user()->can('edit',$model)) return response()->json('Tsk tsk tsk', 403);

        $model->lock();
        $model->save();
    
        return response()->json(['message'=>'locked','type'=>$type,'id'=>$id],200);
    }

    public function nodeStopUpdate(Request $request)
    {
        if ( ! $request->ajax() ) return abort(400);

        $type = $request->input('type');
        $id = $request->input('id');

        if ( ! class_exists($this->namespace.'\\'.$type) ) return response()->json('Tsk tsk tsk', 500);

        if (! ($type && $id) ) return response()->json('Tsk tsk tsk', 500);

        $modelClass = new \ReflectionClass($this->namespace.'\\'.$type);

        if ( ! $modelClass->hasMethod('lock') ) return response()->json('Tsk tsk tsk', 500);
    
        $modelInstance = $modelClass->newInstance();
        $model = $modelInstance->findOrFail($id);

        if (!auth()->user()->can('edit',$model)) return response()->json('Tsk tsk tsk', 403);

        $model->unlock();

        $field = $request->input('field');
        $value = $request->input('value');

        $model->fill([$field=>$value]);

        $model->save();

        return response()->json(['message'=>'STOP!'],200);
    }
}
