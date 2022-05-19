<?php

namespace App\Providers;

use App\Http\View\Composers\DivisionComposer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
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
        View::share('serialNumber', '1');
        View::composer('*', DivisionComposer::class);
        Paginator::useBootstrap();
    }
}
