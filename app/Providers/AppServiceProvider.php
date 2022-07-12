<?php

namespace App\Providers;

use App\Http\View\Composers\DivisionComposer;
use App\Http\View\Composers\NoteComposer;
use App\Http\View\Composers\TypeComposer;
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
   public function register() {
      //
   }

   /**
    * Bootstrap any application services.
    *
    * @return void
    */
   public function boot() {
      View::share('serialNumber', '1');
      View::composer('*', DivisionComposer::class);
      View::composer('*', TypeComposer::class);
      View::composer('*', NoteComposer::class);
      Paginator::useBootstrap();
   }
}
