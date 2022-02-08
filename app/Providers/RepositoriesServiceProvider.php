<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Users\UsersRepository;
use App\Repositories\Users\UsersRepositoryInterface;

class RepositoriesServiceProvider extends ServiceProvider
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
        $this->app->bind(UsersRepositoryInterface::class, UsersRepository::class);
    }
}
