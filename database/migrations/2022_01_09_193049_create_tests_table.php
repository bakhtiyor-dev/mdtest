<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->string('answers_type');
            $table->unsignedBigInteger('answers_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('explanation')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('test_categories')
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
        Schema::dropIfExists('tests');
    }
}
