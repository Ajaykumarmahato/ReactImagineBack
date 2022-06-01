<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ModuleRepositoryInterface;
use App\Repositories\ModuleRepository;
// REPOS USE

class ImagineServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {


        
        $this->app->bind(
            ModuleRepositoryInterface::class,
            ModuleRepository::class
        );
// REPOS BIND END
    }
}
