<?php

if ( !function_exists('policy') ) {
    /**
     * Возращает объект \App\Classes\PolicyDispatcher
     *
     * @see \App\Classes\PolicyDispatcher
     * @return \App\Interfaces\PolicyDispatcherInterface
     */
    function policy() {
        return \App::make(\App\Interfaces\PolicyDispatcherInterface::class);
    }
}