<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamUserAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_user_attempts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_user_id')->nullable();
            $table->json('exam')->nullable();
            $table->json('user')->nullable();
            $table->dateTime('started_at');
            $table->dateTime('finished_at')->nullable();
            $table->float('result')->nullable();
            $table->json('tests')->nullable();
            $table->integer('attempt_number')->default(1);
            $table->timestamps();

            $table->foreign('exam_user_id')
                ->references('id')
                ->on('exam_user')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_user_attempts');
    }
}
