<?php

namespace App\Http\Controllers;

use App\Exports\AdvancedReportExport;
use App\Exports\DivisionReportExport;
use App\Exports\TypeReportExport;
use App\Models\Detention;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
   private $detention;

   public function __construct($detention = []) {
      if ($detention == []) {
         $detention = collect([]);
         $this->detention = $detention;
      } else
         $this->detention = $detention;
   }


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

   public function showAdvancedReport() {
      if (session()->get('advancedReport.detention')->isNotEmpty()) {
         $detention = session()->get('advancedReport.detention')->toQuery()->orderByDesc('date')->paginate(5);
      } else {
         $detention = collect([]);
      }

      return view('report.showAdvancedReport', compact('detention'));
   }

   public function showFormAdvancedReport() {
      if (auth()->user()->role == 'admin' || auth()->user()->role == 'moderator') {
         $user = User::all();
      } else {
         $user = User::query()->where('division_id', '=', auth()->user()->division_id)->get();
      }
      return view('report.createAdvancedReport', compact('user'));
   }

   public function createAdvancedReport(Request $request) {
      $dateStart = $request->input('date_start');
      $dateEnd = $request->input('date_end');
      $dateCreateStart = $request->input('date_create_start');
      $dateCreateEnd = $request->input('date_create_end');
      $dateEditStart = $request->input('date_edit_start');
      $dateEditEnd = $request->input('date_edit_end');

      if ($dateStart > $dateEnd) {
         $temp1 = $dateEnd;
         $dateEnd = $dateStart;
         $dateStart = $temp1;
      }

      if ($dateCreateStart > $dateCreateEnd) {
         $temp2 = $dateCreateEnd;
         $dateCreateEnd = $dateCreateStart;
         $dateCreateStart = $temp2;
      }

      if ($dateEditStart > $dateEditEnd) {
         $temp3 = $dateEditEnd;
         $dateEditEnd = $dateEditStart;
         $dateEditStart = $temp3;
      }

      if (auth()->user()->role == 'admin' or auth()->user()->role == 'moderator') {
         $detentions = Detention::query()
            ->when($dateStart, function ($query, $dateStart) {
               return $query->where('date', '>=', $dateStart);
            })->when($dateEnd, function ($query, $dateEnd) {
               return $query->where('date', '<=', $dateEnd);
            })->when($dateCreateStart, function ($query, $dateCreateStart) {
               return $query->whereDate('created_at', '>=', $dateCreateStart);
            })->when($dateCreateEnd, function ($query, $dateCreateEnd) {
               return $query->whereDate('created_at', '<=', $dateCreateEnd);
            })->when($dateEditStart, function ($query, $dateEditStart) {
               return $query->whereDate('updated_at', '>=', $dateEditStart);
            })->when($dateEditEnd, function ($query, $dateEditEnd) {
               return $query->whereDate('updated_at', '<=', $dateEditEnd);
            })->get();
      } else {
         $detentions = Detention::query()
            ->when($dateStart, function ($query, $dateStart) {
               return $query->where('date', '>=', $dateStart);
            })->when($dateEnd, function ($query, $dateEnd) {
               return $query->where('date', '<=', $dateEnd);
            })->when($dateCreateStart, function ($query, $dateCreateStart) {
               return $query->whereDate('created_at', '>=', $dateCreateStart);
            })->when($dateCreateEnd, function ($query, $dateCreateEnd) {
               return $query->whereDate('created_at', '<=', $dateCreateEnd);
            })->when($dateEditStart, function ($query, $dateEditStart) {
               return $query->whereDate('updated_at', '>=', $dateEditStart);
            })->when($dateEditEnd, function ($query, $dateEditEnd) {
               return $query->whereDate('updated_at', '<=', $dateEditEnd);
            })->where('division_id', '=', auth()->user()->division_id)->get();
      }

      $division = $request->division;
      $type = $request->type;
      $note = $request->note;
      $user = $request->user;
      $kusp = $request->kusp;
      $description = $request->description;
      $explanation = $request->explanation;

      if ($detentions->isNotEmpty()) {
         $detention = $detentions->toQuery()->when($division, function ($query, $division) {
            return $query->whereIn('division_id', $division);
         })->when($type, function ($query, $type) {
            return $query->whereIn('type_id', $type);
         })->when($note, function ($query, $note) {
            return $query->whereIn('note_id', $note);
         })->when($user, function ($query, $user) {
            return $query->whereIn('user_id', $user);
         })->when($kusp, function ($query, $kusp) {
            return $query->where('kusp', $kusp);
         })->when($description, function ($query, $description) {
            return $query->where('description', 'like', "%$description%");
         })->when($explanation, function ($query, $explanation) {
            return $query->where('explanation', 'like', "%$explanation%");
         })->get();
      } else {
         $detention = collect([]);
      }

      Session::put('advancedReport', ['detention' => $detention]);

      return redirect()->route('report.showAdvancedReport');
   }

   public function exportAdvancedReport() {
      $detention = session()->get('advancedReport.detention');

      return Excel::download(new AdvancedReportExport($detention), 'advancedReport.xlsx');
   }
}
