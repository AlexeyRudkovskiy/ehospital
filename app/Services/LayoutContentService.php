<?php

namespace App\Services;

class LayoutContentService
{

    public function getContentClasses($variables)
    {
        $classes = [ 'content' ];

        if (isset($variables['content_scrollable']) && $variables['content_scrollable'] == false) {
            array_push($classes, 'content-overflow-hidden');
        }

        return implode(' ', $classes);
    }

    public function getContentWrapperClasses($variables)
    {
        $classes = [];
        if (!isset($variables['no_content_paddings'])) {
            array_push($classes, 'paddings');
        }

        if (isset($variables['classes'])) {
            $classes = array_merge($classes, $variables['classes']);
        }

        return implode(' ', $classes);
    }

    public function getPageContentClasses($variables)
    {
        $classes = [];
        if (isset($variables['no_content_paddings']) && $variables['no_content_paddings']) {
            if (isset($variables['tabs_as_sidebar']) && $variables['tabs_as_sidebar']) {
                array_push($classes, 'has-sub-sidebar');
                array_push($classes, 'tabs-wrapper');
                array_push($classes, 'tabs-as-sidebar');
            }
        }

        return implode(' ', $classes);
    }

}