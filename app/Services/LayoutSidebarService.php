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
        $lastItem = array_pop($linkArray);
        $page = 'title';
        if ($lastItem != 'index') {
            $page = $lastItem;
        }
        $title = trans('management.breadcrumbs.' . $controller . '.' . $page);

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
        if (gettype($schema) == 'string') {
            $schema = json_decode($schema);
        }

        foreach ($schema as $item) {
            $urls = array_map(function ($item) {
                $path = explode('.', $item->path);
                return array_shift($path);
            }, $item->items);
            if (in_array($this->current, $urls)) {
                $item->active = true;
            } else {
                $item->active = false;
            }
            $sidebar .= view('layouts.sidebar.section')
                ->with('sidebar', $this)
                ->with('item', $item);
        }
        return $sidebar;
    }

}
