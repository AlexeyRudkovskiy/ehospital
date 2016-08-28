<?php

if ( !function_exists('getActionName') ) {
    function getActionName (string $name) {
        $name = explode('.', $name);
        return array_pop($name);
    }
}