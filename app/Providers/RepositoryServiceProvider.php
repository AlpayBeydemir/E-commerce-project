<?php

namespace App\Providers;

use App\Interfaces\ICategoryRepositoryInterface;
use App\Interfaces\IOrderRepositoryInterface;
use App\Interfaces\IProductRepositoryInterface;
use App\Interfaces\IUserRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
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
        $this->app->bind(ICategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(IProductRepositoryInterface::class, ProductRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
