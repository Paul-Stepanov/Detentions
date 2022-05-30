<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserColumnToDetentionsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('detentions', function (Blueprint $table) {
         $table->foreignId('user_id')->nullable()-> constrained()->onUpdate('cascade');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::table('detentions', function (Blueprint $table) {
         $table->dropColumn('user_id');
      });
   }
}
