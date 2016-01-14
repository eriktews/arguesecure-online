<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NodeController extends Controller
{
    /**
     * Retrieve the HTML for the tree visualisation
     * @param  Request $request 
     * @param  \App\Tree  $tree  Tree Model
     * @return string           HTML 
     */
    public function nodeTreeVis(Request $request, $node)
    {
        // if ( ! $request->ajax() ) return abort(400);

        return view('visualisation.leaf', [ 'node' => $node ])->render();
    }
}
