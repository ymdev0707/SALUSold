<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepotExerciseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repot_exercise', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->date('target_date');
            $table->integer('burned_carolie');
            $table->time('burned_time');
            $table->text('user_comment');
            $table->integer('trainer_id')->nullable();
            $table->text('trainer_comment')->nullable();
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
        Schema::dropIfExists('repot_exercise');
    }
}
