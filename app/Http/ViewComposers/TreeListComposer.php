<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Users\Repository as UserRepository;

class TreeListComposer
{
   
    protected $header_tree_list;
    
    public function __construct()
    {
        $this->header_tree_list = \App\Tree::get(['id','name']);
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('header_tree_list', $this->header_tree_list);
    }
}