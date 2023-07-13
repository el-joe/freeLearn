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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('subject_id')->unsigned()->index();
            $table->bigInteger('academic_year_id')->unsigned()->index();
            $table->integer('semester')->default(1);
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price')->default(15);
            $table->integer('expire_hours')->default(15);
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
        Schema::dropIfExists('lessons');
    }
};
