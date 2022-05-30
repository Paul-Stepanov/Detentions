<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnToEditDetentionsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('edit_detentions', function (Blueprint $table) {
         $table->renameColumn('edit_kusp', 'kusp');
         $table->renameColumn('edit_date', 'date');
         $table->renameColumn('edit_division_id', 'division_id');
         $table->renameColumn('edit_type_id', 'type_id');
         $table->renameColumn('edit_description', 'description');
         $table->renameColumn('edit_note_id', 'note_id');
         $table->renameColumn('edit_explanation', 'explanation');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::table('edit_detentions', function (Blueprint $table) {
         $table->renameColumn('kusp', 'edit_kusp');
         $table->renameColumn('date', 'edit_date');
         $table->renameColumn('division_id', 'edit_division_id');
         $table->renameColumn('type_id', 'edit_type_id');
         $table->renameColumn('description', 'edit_description');
         $table->renameColumn('note_id', 'edit_note_id');
         $table->renameColumn('explanation', 'edit_explanation');
      });
   }
}
