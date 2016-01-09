<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\TreeRequest;

use App\Tree;

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
            'trees' => Tree::visible()->paginate(15)
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tree = Tree::findOrFail($id);

        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tree = Tree::findOrFail($id);

        $this->authorize('edit', $tree);

        return view('tree.edit')->with('tree',$tree);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Requests\TreeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TreeRequest $request, $id)
    {
        $tree = Tree::findOrFail($id);

        $this->authorize('update', $tree);

        $tree->update($request->all());

        return redirect()->route('tree.index')->with('success','Tree successfully edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requests\TreeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $tree = Tree::findOrFail($id);

        $this->authorize('destroy', $tree);

        $tree->delete();

        return redirect()->route('tree.index')->with('success','Tree successfully deleted');
    }


    /**
     * Ajax functions
     */
    
    public function ajax(Request $request, $id)
    {
        if ( ! $request->ajax() ) return abort(400);

        $tree = Tree::findOrFail($id);

        return view('partials.tree', [ 'tree' => $tree ])->render();
    }
}
