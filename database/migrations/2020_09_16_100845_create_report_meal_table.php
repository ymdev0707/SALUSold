<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportMealTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_meal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->date('target_date');
            $table->integer('intake_calorie');
            $table->dateTime('intake_time');
            $table->string('user_comment');
            $table->string('report_image')->nullable();
            $table->integer('trainer_id')->nullable();
            $table->integer('trainer_comment')->nullable();
            $table->timestamps();
            $table->integer('del_flg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_meal');
    }
}
