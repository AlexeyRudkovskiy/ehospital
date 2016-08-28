<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FormComponentsProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        \Form::component('twText', 'layouts.form.text', ['name', 'value', 'attributes']);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
