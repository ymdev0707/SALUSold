<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->after('name');
            $table->string('last_name')->after('name');
            $table->string('sex')->after('email_verified_at');
            $table->string('birth')->after('email_verified_at');
            $table->string('user_type')->after('email_verified_at');
            $table->string('area_id')->after('email_verified_at');
            $table->string('account_suspension_flg')->after('email_verified_at');
            $table->string('del_flg')->after('email_verified_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('name');
        });
    }
}
