<?php

namespace App\Http\View\Composers;

use App\Models\Note;

class NoteComposer
{
   public function __construct() {
      //
   }

   public function compose($view) {
      $view->with('note', Note::all());
   }
}
