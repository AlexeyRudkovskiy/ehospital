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
        // Registering custom text form component
        \Form::component('ehText', 'layouts.form.text', ['name', 'label', 'value', 'attributes']);

        // Registering custom number for component
        \Form::component('ehNumber', 'layouts.form.number', ['name', 'label', 'value', 'attributes']);

        // Registering custom radio button form component
        \Form::component('ehRadio', 'layouts.form.radio', ['name', 'value', 'label', 'attributes']);

        // Registering custom checkbox form component
        \Form::component('ehCheckbox', 'layouts.form.checkbox', ['name', 'value', 'label', 'attributes']);

        // Registering radio group
        \Form::component('ehRadioGroup', 'layouts.form.group.radio', ['title', 'options']);

        // Registering save button
        \Form::component('ehSave', 'layouts.form.submit', ['title']);

        // Registering select component
        \Form::component('ehSelect', 'layouts.form.select', ['name', 'elements', 'title', 'current', 'attributes']);
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
