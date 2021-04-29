<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function (Blueprint $table) {
        $table->string('last_name_kana')->after('first_name');
        $table->string('first_name_kana')->after('last_name_kana');
      });
    }
  
    public function down()
    {
      Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('last_name_kana');
        $table->dropColumn('first_name_kana');
      });
    }
}
