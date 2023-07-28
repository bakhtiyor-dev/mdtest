<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->json('test_category_count');
            $table->unsignedInteger('time');

            $table->unsignedBigInteger('rating_setting_id');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('organisation_id')->nullable();

            $table->unsignedInteger('attempts_count')->default(1);

            $table->boolean('can_skip_question')->default(true);
            $table->boolean('can_return_to_passed_question')->default(true);
            $table->boolean('can_complete_untill_all_answered')->default(true);

            $table->boolean('enable_explanation')->default(false);
            $table->timestamps();

            $table->foreign('rating_setting_id')
                ->references('id')
                ->on('rating_settings')
                ->restrictOnDelete();

            $table->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->restrictOnDelete();

            $table->foreign('organisation_id')
                ->references('id')
                ->on('organisations')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
