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

        if ($view_data = $view->getData()) {
            if (array_key_exists('tree', $view_data))
                $sidebar_tags = $view_data['tree']->getAllTags();
            elseif (array_key_exists('risk', $view_data))
                $sidebar_tags = $view_data['risk']->getAllTags();
            elseif (array_key_exists('attack', $view_data))
                $sidebar_tags = $view_data['attack']->getAllTags();
            elseif (array_key_exists('defence', $view_data))
                $sidebar_tags = $view_data['defence']->getAllTags();
        }

        debug($sidebar_tags);

        $view->with('sidebar_tags', $sidebar_tags);
    }
}