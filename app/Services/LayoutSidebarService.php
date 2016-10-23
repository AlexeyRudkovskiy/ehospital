<?php

namespace App\Services;

use App\Permission;
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

    /**
     * @param Permission $permission
     *
     * @return string
     */
    public function make(Permission $permission)
    {
        $schema = $permission->sidebar;
        $sidebar = '';
        foreach ($schema as $item) {
            $sidebar .= view('layouts.sidebar.section', $item)
                ->with('sidebar', $this);
        }
        return $sidebar;
    }

}
