<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUserUpdateToEditDetentionsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('edit_detentions', function (Blueprint $table) {
         $table->bigInteger('user_update')->nullable();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::table('edit_detentions', function (Blueprint $table) {
         $table->dropColumn('user_update');
      });
   }
}