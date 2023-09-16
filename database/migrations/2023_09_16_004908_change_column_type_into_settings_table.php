<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        DB::statement("ALTER TABLE `settings` CHANGE `column_type` `column_type` ENUM('text','textarea','url','file','checkbox','select','radio','number','float','array') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        DB::statement("ALTER TABLE `settings` CHANGE `value` `value` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
