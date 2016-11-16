<?php

namespace App\Providers;

use App\Classes\PolicyDispatcher;
use App\Contractor;
use App\Department;
use App\Http\Requests\DepartmentRequest;
use App\Interfaces\PolicyDispatcherInterface;
use App\Organization;
use App\Policies\ContractorPolicy;
use App\Policies\DepartmentPolicy;
use App\Policies\OrganizationPolicy;
use App\Policies\TestPolicy;
use App\Test;
use Illuminate\Support\ServiceProvider;

/**
 * Class PolicyProvider
 *
 * Провайдер для работы с правами доступа
 *
 * @author Alexey Rudkovskiy
 * @package App\Providers
 */
class PolicyProvider extends ServiceProvider
{

    protected $policies = [
        Test::class => TestPolicy::class,
        Organization::class => OrganizationPolicy::class,
        Department::class => DepartmentPolicy::class,
        Contractor::class => ContractorPolicy::class,
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->policies as $target => $policy) {
            $this->policies[$target] = new $policy;
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $instance = $this;
        $this->app->singleton(PolicyDispatcherInterface::class, function () use ($instance) {
            $dispatcher = (new PolicyDispatcher())->init();

            foreach ($this->policies as $target => $policy) {
                $dispatcher->register($target, $policy);
            }

            return $dispatcher;
        });

        $this->app->bind('policy', function () {
            return 1;
        });
    }

}
