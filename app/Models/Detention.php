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
      'editing',
      'user_update',
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

   public function edit_detentions() {
      return $this->hasMany(EditDetention::class);
   }

   public function user() {
      return $this->belongsTo(User::class);
   }

}
