<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCommentDelitingToDetentionsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('detentions', function (Blueprint $table) {
         $table->string('comment_to_deleting')->nullable();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::table('detentions', function (Blueprint $table) {
         $table->dropColumn('comment_to_deleting');
      });
   }
}
