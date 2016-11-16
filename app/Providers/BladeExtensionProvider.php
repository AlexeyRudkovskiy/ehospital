<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeExtensionProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('can', function ($what) {
            return "<?php if(auth()->user()->granted($what)): ?>";
        });

        Blade::directive('endcan', function () {
            return '<?php endif; ?>';
        });

        Blade::directive('orcan', function ($what) {
            return "<?php elseif(auth()->user()->granted($what)): ?>";
        });


        \Auth::extend('jwt', function($app, $name, array $config) {
            return new \App\Classes\MyGate(\Auth::createUserProvider($config['provider']));
        });
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
