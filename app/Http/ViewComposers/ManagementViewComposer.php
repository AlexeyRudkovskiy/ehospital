<?php

namespace App\Http\ViewComposers;

use App\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ManagementViewComposer
{

    /**
     * @var User
     */
    protected $user = null;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function compose(View $view)
    {
        $currentRoute = request()->route()->getName();
        $currentRoute = explode('.', $currentRoute);
        $savedCurrentRoute = $currentRoute;
        $currentRoute = array_shift($currentRoute);
        $action = array_shift($savedCurrentRoute);
        $action = array_shift($savedCurrentRoute);

        $breadcrumbs = [
            'management.breadcrumbs.index',
            'management.breadcrumbs.' . $currentRoute . '.title',
            'management.breadcrumbs.' . $currentRoute . '.' . $action
        ];

        $view->with('action', $action);
        $view->with('current', $this->user);
        $view->with('controller', $currentRoute);
        $view->with('breadcrumbs', $breadcrumbs);
    }

}