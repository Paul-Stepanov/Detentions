<?php

namespace App\Imports;

use App\Models\Division;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class DivisionsImport implements ToModel
{
   /**
    * @param array $row
    *
    * @return Model|null
    */
   public function model(array $row) {
      return new Division([
         'title' => $row[0],
      ]);
   }
}
