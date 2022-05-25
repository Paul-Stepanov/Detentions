<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditDetention extends Model
{
   use HasFactory;

   protected $fillable = [
      'edit_kusp',
      'edit_date',
      'edit_division_id',
      'edit_type_id',
      'edit_description',
      'edit_note_id',
      'edit_explanation',
      'detention_id',
   ];

   public function detentions() {
      return $this->belongsTo(Detention::class);
   }
}
