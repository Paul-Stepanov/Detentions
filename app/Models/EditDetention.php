<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditDetention extends Model
{
   use HasFactory;

   protected $dates = ['date'];


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

   public function detention() {
      return $this->belongsTo(Detention::class);
   }

   public function type() {
      return $this->belongsTo(Type::class );
   }

   public function division() {
      return $this->belongsTo(Division::class);
   }

   public function note() {
      return $this->belongsTo(Note::class);
   }
}
