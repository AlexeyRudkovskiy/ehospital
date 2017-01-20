<?php

namespace App\Services;

use App\Permission;
use Illuminate\View\View;

class LayoutSidebarService {

    /**
     * @var string
     */
    protected $current = null;

    /**
     * @var string
     */
    protected $currentController = null;

    /**
     * @var string
     */
    protected $currentAction = null;

    public function __construct()
    {
        $currentRoute = request()->route() != null ? request()->route()->getName() : '';
//        $currentRoute = explode('.', $currentRoute);
        $this->current = $currentRoute;
        $this->currentController = explode('.', $this->current);
        $this->currentAction = array_pop($this->currentController);
        $this->currentController = array_pop($this->currentController);
    }

    public function link(string $link, $badge = null, $checkByFullPath = null, $actions = []) : View
    {
        $linkArray = explode('.', $link);
        $controller = array_shift($linkArray);
        $lastItem = array_pop($linkArray);
        $page = 'title';
        $action = $lastItem;
        if ($lastItem != 'index') {
            $page = $lastItem;
        }
        $title = trans('management.breadcrumbs.' . $controller . '.' . $page);

        $active = false;
        if ($checkByFullPath) {
            // dd($actions);
            if (!in_array($this->currentAction, $actions)) {
                $this->currentAction = 'index';
            }
            $active = $action == $this->currentAction && $controller == $this->currentController;
            echo '<!-- ' . $action . ', ' . json_encode($actions) . ' , ' . $this->currentAction . ' -->';
        } else {
            $active = $this->current == $link || $controller == $this->currentController;
        }

        return view('layouts.html.sidebar.item')
            ->with('title', $title)
            ->with('badge', $badge)
            ->with('link', $link)
            ->with('active', $active);
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

        $currentController = $this->currentController;
        foreach ($schema as $item) {
            if (property_exists($item, 'link') && $item->link) {
                $sidebar .= $this->link($item->path, null, null, []);

                continue;
            }

            $urls = array_map(function ($item) {
                return $item->path;
            }, $item->items);

            $hasItemsWithSameController = false;
            $hasCurrentController = false;

            array_map(function ($item) use ($currentController, &$hasCurrentController) {
                $item = explode('.', $item);
                array_pop($item);
                $item = array_pop($item);
                if ($item == $currentController) {
                    $hasCurrentController = true;
                }
            }, $urls);

            array_map(function ($item) use (&$hasItemsWithSameController, $urls) {
                $item = explode('.', $item);
                array_pop($item);
                $item = array_pop($item);

                $count = 0;
                foreach ($urls as $url) {
                    $pos = strpos($url, $item);
                    if ($pos !== false && $pos == 0) {
                        $count++;
                    }
                }

                if ($count > 1) {
                    $hasItemsWithSameController = true;
                }
            }, $urls);

            if ($hasItemsWithSameController) {
                if (in_array($this->current, $urls)) {
                    $item->active = true;
                } else {
                    $item->active = false;
                }

                $actions = array_map(function ($url) {
                    $url = explode('.', $url);
                    return array_pop($url);
                }, $urls);

                $currentAction = null;
                if (!in_array($this->currentAction, $actions)) {
                    $currentAction = 'index';
                } else {
                    $currentAction = $this->currentAction;
                }
                $item->active = in_array($currentAction, $actions) && $hasCurrentController;
            } else {
                $isActive = false;
                $self = $this;

                array_map(function ($item) use (&$isActive, $self) {
                    $item = explode('.', $item);
                    array_pop($item);
                    $item = array_pop($item);

                    if ($item == $self->currentController) {
                        $isActive = true;
                    }
                }, $urls);

                $item->active = $isActive;
                $actions = [];
            }

            $sidebar .= view('layouts.sidebar.section')
                ->with('sidebar', $this)
                ->with('item', $item)
                ->with('manyItemsWithSameController', $hasItemsWithSameController)
                ->with('actions', $actions);
        }
        return $sidebar;
    }

}
