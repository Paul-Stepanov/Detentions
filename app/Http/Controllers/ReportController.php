<?php

namespace App\Http\Controllers;

use App\Exports\DivisionReportExport;
use App\Exports\TypeReportExport;
use App\Models\Detention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
   public function showTypeReport() {

      return view('report.showTypeReport');
   }

   public function createTypeReport(Request $request) {

      $validationRules = [
         'date_start' => 'required',
         'date_end' => 'required',
      ];

      $errorMessage = [
         'required' => 'Поле обязательно для заполнения',
      ];

      $request->validate($validationRules, $errorMessage);

      $dateStart = $request->input('date_start');
      $dateEnd = $request->input('date_end');

      if ($dateStart > $dateEnd) {
         $temp = $dateEnd;
         $dateEnd = $dateStart;
         $dateStart = $temp;
      }

      $dates = [$dateStart, $dateEnd];
      $month = [
         1 => 'Январь',
         2 => 'Февраль',
         3 => 'Март',
         4 => 'Апрель',
         5 => 'Май',
         6 => 'Июнь',
         7 => 'Июль',
         8 => 'Август',
         9 => 'Сентябрь',
         10 => 'Октябрь',
         11 => 'Ноябрь',
         12 => 'Декабрь',
      ];

      if (auth()->user()->role == 'admin' or auth()->user()->role == 'moderator') {
         $detention = Detention::query()
            ->where('date', '>=', $dateStart)->where('date', '<=', $dateEnd)->get();
      } else {
         $detention = Detention::query()
            ->where('date', '>=', $dateStart)->where('date', '<=', $dateEnd)
            ->where('division_id', auth()->user()->division_id)->get();
      }

      if ($detention->isNotEmpty()) {
         $uniqType = $detention->toQuery()
            ->join('types', 'detentions.type_id', '=', 'types.id')
            ->select('types.title', 'types.id')
            ->distinct()->get();
      } else {
         $uniqType = [];
      }
      Session::put('typeReport', [
         'detention' => $detention,
         'uniqType' => $uniqType,
         'dates' => $dates,
         'month' => $month
      ]);
      return view('report.showTypeReport', compact(['detention', 'uniqType', 'dates', 'month']));
   }

   public function exportTypeReport() {
      $detention = session()->get('typeReport.detention');
      $uniqType = session()->get('typeReport.uniqType');
      $dates = session()->get('typeReport.dates');
      $month = session()->get('typeReport.month');

      return Excel::download(new TypeReportExport($detention, $uniqType, $dates, $month), 'typeReport.xlsx');
   }

   public function showDivisionReport() {
      return view('report.showDivisionReport');
   }

   public function createDivisionReport(Request $request) {
      $validationRules = [
         'date_start' => 'required',
         'date_end' => 'required',
      ];

      $errorMessage = [
         'required' => 'Поле обязательно для заполнения',
      ];

      $request->validate($validationRules, $errorMessage);

      $dateStart = $request->input('date_start');
      $dateEnd = $request->input('date_end');

      if ($dateStart > $dateEnd) {
         $temp = $dateEnd;
         $dateEnd = $dateStart;
         $dateStart = $temp;
      }

      $dates = [$dateStart, $dateEnd];

      if (auth()->user()->role == 'admin' or auth()->user()->role == 'moderator') {
         $detention = Detention::query()
            ->where('date', '>=', $dateStart)->where('date', '<=', $dateEnd)->get();
      } else {
         $detention = Detention::query()
            ->where('date', '>=', $dateStart)->where('date', '<=', $dateEnd)
            ->where('division_id', auth()->user()->division_id)->get();
      }

      if ($detention->isNotEmpty()) {
         $uniqType = $detention->toQuery()
            ->join('types', 'detentions.type_id', '=', 'types.id')
            ->select('types.title', 'types.id')
            ->distinct()->get();
         $uniqDivision = $detention->toQuery()
            ->join('divisions', 'detentions.division_id', '=', 'divisions.id')
            ->select('divisions.title', 'divisions.id')
            ->distinct()->get();
         $column = $uniqDivision->count();
      } else {
         $uniqType = [];
         $uniqDivision = [];
         $column = 0;
      }

      Session::put('divisionReport', [
         'detention' => $detention,
         'uniqType' => $uniqType,
         'uniqDivision' => $uniqDivision,
         'dates' => $dates,
         'column' => $column,
      ]);

      return view('report.showDivisionReport', compact(['detention', 'uniqType', 'uniqDivision', 'dates', 'column']));
   }

   public function exportDivisionReport() {
      $detention = session()->get('divisionReport.detention');
      $uniqType = session()->get('divisionReport.uniqType');
      $uniqDivision = session()->get('divisionReport.uniqDivision');
      $dates = session()->get('divisionReport.dates');

      return Excel::download(new DivisionReportExport($detention, $uniqType, $uniqDivision, $dates), 'divisionReport.xlsx');
   }
}
