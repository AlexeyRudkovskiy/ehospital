<?php

namespace App\Services;

use Illuminate\View\View;

class LayoutSidebarService {

    /**
     * @var string
     */
    protected $current = null;

    public function __construct()
    {
        $currentRoute = request()->route() != null ? request()->route()->getName() : '';
        $currentRoute = explode('.', $currentRoute);
        $this->current = array_shift($currentRoute);
    }

    public function link(string $link, $badge = null) : View
    {
        $linkArray = explode('.', $link);
        $controller = array_shift($linkArray);
        $title = trans('management.breadcrumbs.' . $controller . '.title');

        return view('layouts.html.sidebar.item')
            ->with('title', $title)
            ->with('badge', $badge)
            ->with('link', $link)
            ->with('active', $this->current == $controller);
    }

}
