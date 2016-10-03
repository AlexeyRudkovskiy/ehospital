<?php

namespace App\Services;

class MiIconService {

    protected $positiveClass = 'mi-icon-success';

    protected $negativeClass = 'mi-icon-danger';

    public function toggle($condition, $positive = 'done', $negative = 'close', $attributes = [])
    {
        $attributes = array_merge($attributes, [
            'classes' => [
                'mi-no-left-padding'
            ]
        ]);
        $class = $condition ? $this->positiveClass : $this->negativeClass;
        $class .= ' ' . implode($attributes['classes']);
        return '<i class="mi-icon ' . $class . '">' . ($condition ? $positive : $negative) . '</i>';
    }

}