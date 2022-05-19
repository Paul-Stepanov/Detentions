<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TypeReportExport implements FromView
{

   private $detention;
   private $uniqType;
   private $dates;
   private $month;

   public function __construct($detention, $uniqType, $dates, $month) {
      $this->detention = $detention;
      $this->uniqType = $uniqType;
      $this->dates = $dates;
      $this->month = $month;

   }

   public function view(): View {
      return view('report.exportTypeReport', [
         'detention' => $this->detention,
         'uniqType' => $this->uniqType,
         'dates' => $this->dates,
         'month' => $this->month,
      ]);
   }
}
