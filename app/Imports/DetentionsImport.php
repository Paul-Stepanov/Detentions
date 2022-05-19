<?php

namespace App\Imports;

use App\Models\Detention;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class DetentionsImport implements ToModel
{
   /**
    * @param array $row
    *
    * @return Model|null
    */
   public function model(array $row) {
      return new Detention([
         'kusp' => $row[0],
         'date' => $row[1],
         'division_id' => $row[2],
         'type_id' => $row[3],
         'description' => $row[4],
         'explanation' => $row[5],
         'note_id' => $row[6],
      ]);
   }
}
