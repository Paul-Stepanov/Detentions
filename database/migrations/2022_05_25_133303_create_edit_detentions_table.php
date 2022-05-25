<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditDetentionsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('edit_detentions', function (Blueprint $table) {
         $table->id();
         $table->integer('edit_kusp')->nullable();
         $table->date('edit_date');
         $table->integer('edit_division_id');
         $table->integer('edit_type_id');
         $table->text('edit_description');
         $table->integer('edit_note_id')->nullable();
         $table->string('edit_explanation')->nullable();
         $table->foreignId('detention_id')->constrained()->onUpdate('cascade');
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::dropIfExists('edit_detentions');
   }
}
