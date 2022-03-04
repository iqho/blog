<?php

namespace App\Providers;

use App\Models\Admin\Page;
use App\Models\Admin\Post;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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

         Gate::define('isCommon', function($user) {
            return $user->user_type != '0';
         });



         $navPage = Page::where('is_nav', 1)->orderBy('page_order','asc')->get()->take(5);
        View::share('navPage', $navPage);
    }
}
