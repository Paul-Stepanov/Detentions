<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AdvancedReportExport implements FromView
{
   private $detention;

   public function __construct($detention) {
      $this->detention = $detention;
   }

   public function view(): View {
      return view('report.exportAdvancedReport', ['detention' => $this->detention]);
   }
}
