<?php

namespace App\Exports;

use App\Models\Detention;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DetentionsExport implements FromView
{
   public function view(): View {
      if (auth()->user()->role == 'admin' or auth()->user()->role == 'moderator') {
         $detentions = Detention::all();
      } else {
         $detentions = Detention::query()->where('division_id', auth()->user()->division_id)->get();
      }
      return view('detention.exportDetentions', compact('detentions'));
   }
}
