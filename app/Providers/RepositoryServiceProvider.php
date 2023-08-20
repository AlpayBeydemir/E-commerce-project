<?php

namespace App\Providers;

use App\Interfaces\IOrderRepositoryInterface;
use App\Interfaces\IUserRepositoryInterface;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IOrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(IUserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
