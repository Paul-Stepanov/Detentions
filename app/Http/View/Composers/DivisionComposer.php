<?php

namespace App\Http\View\Composers;


use App\Models\Division;

class DivisionComposer
{
   public function __construct() {

   }

   public function compose($view) {
      $view->with('division', Division::all());
   }
}
