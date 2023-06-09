<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
   use HasFactory;

   /*-----------------------------------------------------------------------------
   Поля таблицы, которым разрешено массовое присвоение данных ↓
-----------------------------------------------------------------------------*/
   protected $fillable = [
      'title',
   ];

   public function detentions() {
      return $this->hasMany(Detention::class);
   }
   public function users() {
      return $this->hasMany(User::class);
   }
   public function editDetentions() {
      return $this->hasMany(EditDetention::class);
   }
}
