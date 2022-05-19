<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DivisionReportExport implements FromView
{
   private $detention;
   private $uniqType;
   private $uniqDivision;
   private $dates;

   public function __construct($detention, $uniqType, $uniqDivision, $dates) {
      $this->detention = $detention;
      $this->uniqType = $uniqType;
      $this->uniqDivision = $uniqDivision;
      $this->dates = $dates;
   }

   public function view(): View {
      return view('report.exportDivisionReport', [
         'detention' => $this->detention,
         'uniqType' => $this->uniqType,
         'uniqDivision' => $this->uniqDivision,
         'dates' => $this->dates,
      ]);
   }
}
