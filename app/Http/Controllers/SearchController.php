<?php

namespace App\Http\Controllers;

use App\Exports\SearchDetentionsExport;
use App\Models\Detention;
use App\Models\Division;
use App\Models\Note;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class SearchController extends Controller
{
   private $detention;

   public function __construct($detention = null) {
      $this->detention = $detention;
   }

   public function createSearchResults(Request $request) {

      $kusp = $request->input('kusp');
      $dateStart = $request->input('dateStart');
      $dateEnd = $request->input('dateEnd');
      $dateCreateStart = $request->input('dateCreateStart');
      $dateCreateEnd = $request->input('dateCreateEnd');
      $dateUpdateStart = $request->input('dateUpdateStart');
      $dateUpdateEnd = $request->input('dateUpdateEnd');
      $divisions = $request->input('division');
      $types = $request->input('type');
      $explanation = $request->input('explanation');
      $notes = $request->input('note');
      $description = $request->input('description');

      if ($dateCreateStart > $dateCreateEnd & $dateCreateStart != null & $dateCreateEnd != null) {
         $temp1 = $dateCreateEnd;
         $dateCreateEnd = $dateCreateStart;
         $dateCreateStart = $temp1;
      }
      if ($dateUpdateStart > $dateUpdateEnd & $dateUpdateStart != null & $dateUpdateEnd != null) {
         $temp2 = $dateUpdateEnd;
         $dateUpdateEnd = $dateUpdateStart;
         $dateUpdateStart = $temp2;
      }
      if ($dateStart > $dateEnd & $dateStart != null & $dateEnd != null) {
         $temp3 = $dateEnd;
         $dateEnd = $dateStart;
         $dateStart = $temp3;
      }

      $detention = Detention::query()->when($kusp, function ($query, $kusp) {
         return $query->where('kusp', '=', $kusp);
      })->when($dateStart, function ($query, $dataStart) {
         return $query->where('date', '>=', $dataStart);
      })->when($dateEnd, function ($query, $dataEnd) {
         return $query->where('date', '<=', $dataEnd);
      })->when($divisions, function ($query, $divisions) {
         return $query->where('division_id', '=', $divisions);
      })->when($types, function ($query, $types) {
         return $query->where('type_id', '=', $types);
      })->when($explanation, function ($query, $explanation) {
         return $query->where('explanation', 'like', "%$explanation%");
      })->when($notes, function ($query, $notes) {
         return $query->where('note_id', '=', "$notes");
      })->when($description, function ($query, $description) {
         return $query->where('description', 'like', "%$description%");
      })->when($dateCreateStart, function ($query, $dateCreateStart) {
         return $query->whereDate('created_at', '>=', $dateCreateStart);
      })->when($dateCreateEnd, function ($query, $dateCreateEnd) {
         return $query->whereDate('created_at', '<=', $dateCreateEnd);
      })->when($dateUpdateStart, function ($query, $dateUpdateStart) {
         return $query->whereDate('updated_at', '>=', $dateUpdateStart);
      })->when($dateUpdateEnd, function ($query, $dateUpdateEnd) {
         return $query->whereDate('updated_at', '<=', $dateUpdateEnd);
      })->get();

      Session::put('searchResult', $detention);
      return redirect()->route('search.showSearchResults');
   }

   public function showForm() {
      $division = Division::all();
      $type = Type::all();
      $note = Note::all();
      return view('search.searchForm', compact('division', 'type', 'note'));
   }

   public function showSearchResults() {
      if (session()->get('searchResult')->isNotEmpty()) {
         $detention = session()->get('searchResult')->toQuery()->orderByDesc('date')->paginate(5);
      } else {
         $detention = collect([]);
      }
      return view('search.showSearch', compact('detention'));
   }

   public function export() {
      $detention = session()->get('searchResult');
      return Excel::download(new SearchDetentionsExport($detention), 'detentionSearch.xlsx');
   }

}
