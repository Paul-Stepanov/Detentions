<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetentionsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::create('detentions', function (Blueprint $table) {
         $table->id();
         $table->integer('kusp')->nullable();
         $table->date('date');
         $table->foreignId('division_id')->constrained()->onUpdate('cascade');
         $table->foreignId('type_id')->constrained()->onUpdate('cascade');
         $table->text('description')->unique();
         $table->foreignId('note_id')->nullable()->constrained()->onUpdate('cascade');
         $table->string('explanation')->nullable();
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::dropIfExists('detentionsApp');
   }
}
