<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_exams', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('subscription_id')->unsigned()->index();
            $table->bigInteger('lesson_exam_id')->unsigned()->index();
            $table->integer('answer');
            $table->boolean('score')->default(0);
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
        Schema::dropIfExists('subscription_exams');
    }
};
