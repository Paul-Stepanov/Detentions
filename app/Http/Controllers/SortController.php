<?php

namespace App\Http\Controllers;

use App\Models\Detention;

class SortController extends Controller
{
   public function sortColumn($column, $sorted) {
      $detention = Detention::query()->orderBy($column, $sorted)->paginate(5);
      return view('detention.detentions', compact('detention', 'sorted'));
   }

}
