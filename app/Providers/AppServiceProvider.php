<?php

namespace App\Providers;

use App\Interfaces\Repositories\General\AppRepositoryInterface;
use App\Interfaces\Repositories\General\MethodRepositoryInterface;
use App\Interfaces\Repositories\General\TagRepositoryInterface;
use App\Interfaces\Repositories\General\TestRepositoryInterface;
use App\Repositories\General\AppRepository;
use App\Repositories\General\MethodRepository;
use App\Repositories\General\TagRepository;
use App\Repositories\General\TestRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AppRepositoryInterface::class, AppRepository::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
        $this->app->bind(TestRepositoryInterface::class, TestRepository::class);
        $this->app->bind(MethodRepositoryInterface::class, MethodRepository::class);
    }
}
