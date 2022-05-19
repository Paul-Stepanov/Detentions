<?php

namespace App\Exports;

use App\Models\Detention;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DetentionsExport implements FromView
{
   public function view(): View {
      return view('detention.exportDetentions', [
         'detentions' => Detention::all()
      ]);
   }
}


//}class DetentionsExport implements FromCollection, WithHeadings
//{
//   public function collection() {
//
//      return Detention::all();
//   }
//
//
////   public function map($detention): array {
////
////   }
//
//   public function headings(): array {
//      return [
//         'id',
//         'kusp',
//         'date',
//         'division',
//         'type',
//         'description',
//         'explanation',
//         'note',
//         'created_at',
//         'updated_at'
//      ];
//   }
//}
