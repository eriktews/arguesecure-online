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
            'trees' => Tree::all()
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

        $this->syncCategories($new_tree, $request->input('categories'));
        
        return redirect()->route('tree.show',$new_tree->id)->with('succes','Tree successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tree  $tree  Tree Model
     * @return \Illuminate\Http\Response
     */
    public function show($tree)
    {
        return view('tree.view')->with('tree',$tree);
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
                'id' => $tree->id
                ]
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
        $this->syncCategories($tree, $request->input('categories'));

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

        if ($tree->delete()) {

            if ($request->ajax())
            {
                return response()->json(['message' => 'Tree '.$tree->id.': '.$tree->title.' succesfully deleted'],200);
            }
    
            return redirect()->route('tree.index')->with('success','Tree successfully deleted');
    
        }

        if ($request->ajax()) {
            return response()->json(['message'=>'currently in use'],400);
        }

        return abort(400);
    }

    /**
     * Category functions
     */
    private function syncCategories($tree, $categories)
    {
        if ( !is_array($categories) ) return 1;

        $slugged = array_map('str_slug', $categories);

        $tree->categories()->sync([]);
        //For each tag check if it exists, if so, then attach it, if not, create it
        foreach ($slugged as $key => $value) {
            if ($value != "") {
                if (!$category = \App\Category::where('slug','=',str_slug($value))->first())
                {
                    $category = \App\Category::create(['title'=>$categories[$key],'slug'=>$value]);
                }
                $tree->categories()->attach($category->id);
            }
        }

        $this->pruneCategories();

    }

    private function pruneCategories()
    {
        $empty_categories = \App\Category::doesntHave('trees')->get(['id'])->pluck('id')->toArray();

        \App\Category::destroy($empty_categories);
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
