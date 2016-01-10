<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\TreeRequest;

use App\Tree;

use JavaScript;

class TreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tree.index', [
            'trees' => Tree::paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tree.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Requests\TreeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TreeRequest $request)
    {
        $new_tree = Tree::create($request->all());

        return redirect()->route('tree.index')->with('succes','Tree successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tree  $tree  Tree Model
     * @return \Illuminate\Http\Response
     */
    public function show($tree)
    {
        return $tree;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tree  $tree  Tree Model
     * @return \Illuminate\Http\Response
     */
    public function edit($tree)
    {
        $this->authorize('edit', $tree);

        $tree->lock();

        $tree->save();

        JavaScript::put([
            'model' => [
                'type' => (new \ReflectionClass($tree))->getShortName(),
                'id' => $tree->id]
            ]);

        return view('tree.edit')->with('tree',$tree);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Requests\TreeRequest  $request
     * @param  \App\Treee  $tree  Tree Model
     * @return \Illuminate\Http\Response
     */
    public function update(TreeRequest $request, $tree)
    {
        $this->authorize('update', $tree);

        $tree->unlock();

        $tree->update($request->all());

        return redirect()->route('tree.index')->with('success','Tree successfully edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requests\Request  $request
     * @param  \App\Tree $tree Tree Model
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $tree)
    {
        $this->authorize('destroy', $tree);

        $tree->delete();

        return redirect()->route('tree.index')->with('success','Tree successfully deleted');
    }


    /**
     * Ajax functions
     */
    
    /**
     * Retrieve the HTML for the tree
     * @param  Request $request 
     * @param  \App\Tree  $tree  Tree Model
     * @return string           HTML 
     */
    public function ajax(Request $request, $tree)
    {
        if ( ! $request->ajax() ) return abort(400);

        return view('partials.tree', [ 'tree' => $tree ])->render();
    }
}