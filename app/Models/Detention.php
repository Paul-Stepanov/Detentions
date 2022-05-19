<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detention extends Model
{
   use HasFactory;

   protected $fillable = [
      'kusp',
      'date',
      'division_id',
      'type_id',
      'description',
      'note_id',
      'explanation',
   ];

   protected $dates = ['date'];

   public function division() {
      return $this->belongsTo(Division::class);
   }

   public function type() {
      return $this->belongsTo(Type::class);
   }

   public function note() {
      return $this->belongsTo(Note::class);
   }

}
