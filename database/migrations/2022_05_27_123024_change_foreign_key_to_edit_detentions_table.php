<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeForeignKeyToEditDetentionsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('edit_detentions', function (Blueprint $table) {
         $table->foreignId('edit_division_id')->change()->constrained('divisions', 'id');
         $table->foreignId('edit_type_id')->change()->constrained('types', 'id');
         $table->foreignId('edit_note_id')->change()->constrained('notes', 'id');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::table('edit_detentions', function (Blueprint $table) {
         $table->integer('edit_division_id')->change();
         $table->integer('edit_type_id')->change();
         $table->integer('edit_note_id')->nullable()->change();
      });
   }
}
