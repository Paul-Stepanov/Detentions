<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SearchDetentionsExport implements FromView
{
   private $detention;

   public function __construct($detention) {
      $this->detention = $detention;
   }

   public function view(): View {
      return view('search.exportSearchDetentions', ['detention'=>$this->detention]);
   }
}
