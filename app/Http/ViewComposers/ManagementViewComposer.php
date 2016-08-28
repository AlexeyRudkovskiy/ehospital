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
        $currentRoute = array_shift($currentRoute);
        $view->with('current', $this->user);
        $view->with('controller', $currentRoute);
    }

}