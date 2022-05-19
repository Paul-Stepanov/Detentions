<?php

namespace App\Imports;

use App\Models\Note;
use Maatwebsite\Excel\Concerns\ToModel;

class NotesImport implements ToModel
{
   /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   public function model(array $row) {
      return new Note([
         'title' => $row[0],
      ]);
   }
}
