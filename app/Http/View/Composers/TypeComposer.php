<?php

namespace App\Http\View\Composers;

use App\Models\Type;

class TypeComposer
{
   public function __construct() {
      //
   }

   public function compose($view) {
      $view->with('type', Type::all());
   }
}
