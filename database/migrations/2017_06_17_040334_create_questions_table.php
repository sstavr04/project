<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quiz_id')->unsigned();
            $table->string('body');
            $table->boolean('isMultiple')->default(0);//0 is short answered, 1 is multiple choice
            $table->foreign('quiz_id')->references('id')->on('quizzes');
            $table->float('correct_points')->unsigned()->default(0.0);
            $table->float('wrong_points')->unsigned()->default(0.0);
            $table->integer('minutes')->nullable();//max 60
            $table->integer('seconds')->nullable();//max 60
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
