<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Users\Repository as UserRepository;

class SidebarViewComposer
{
       
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $sidebar_tags = [];

        if (isset($view->getData()['tree']) && !isset($view->getData()['trees']))
        {
            $sidebar_tags = $view->getData()['tree']->getAllTags();
        }

        $view->with('sidebar_tags', $sidebar_tags);
    }
}