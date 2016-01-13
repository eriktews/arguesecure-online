<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Users\Repository as UserRepository;

class SidebarViewComposer
{
   
    protected $sidebar_trees;
    
    public function __construct()
    {
        $this->sidebar_trees = \App\Tree::get(['id','title']);
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('sidebar_trees', $this->sidebar_trees);
    }
}