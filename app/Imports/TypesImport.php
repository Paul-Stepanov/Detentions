<?php

namespace App\Imports;

use App\Models\Type;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class TypesImport implements ToModel
{
   /**
    * @param array $row
    *
    * @return Model|null
    */
   public function model(array $row) {
      return new Type([
         'title' => $row[0],
      ]);
   }
}
