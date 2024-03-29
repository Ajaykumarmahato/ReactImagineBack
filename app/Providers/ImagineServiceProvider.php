<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ModuleRepositoryInterface;
use App\Repositories\ModuleRepository;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\NominalAccountRepositoryInterface;
use App\Repositories\NominalAccountRepository;
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

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            NominalAccountRepositoryInterface::class,
            NominalAccountRepository::class
        );
// REPOS BIND END
    }
}
