<?php

namespace App\Providers;

use App\Interfaces\UserInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function boot(){
       
    }
    public function register()
    {
       
        // $this->app->bind('App\Interfaces\UserInterface', 'App\Repositories\UserRepository');
    }
}
