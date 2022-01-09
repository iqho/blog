<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultstringLength(191);
        Paginator::useBootstrap();


        Gate::define('isAdmin', function($user) {
            return $user->user_type == '1';
         });
        Gate::define('isEditor', function($user) {
            return $user->user_type == '2';
         });
        Gate::define('isAuthor', function($user) {
            return $user->user_type == '3';
         });
        Gate::define('isContributor', function($user) {
            return $user->user_type == '4';
         });
        Gate::define('isSubscribers', function($user) {
            return $user->user_type == '0';
         });

    }
}
