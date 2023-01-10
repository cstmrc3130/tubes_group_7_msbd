<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Update 
        DB::unprepared(
            'CREATE TRIGGER update_school_year BEFORE UPDATE ON school_years
            FOR EACH ROW BEGIN
               SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "You Can not Change it!";
               END'
        );


        DB::unprepared(
            'CREATE TRIGGER delete_school_year BEFORE DELETE ON school_years
            FOR EACH ROW BEGIN
               SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "You can not Delete it!!";
               END'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER update_school_year');
        DB::unprepared('DROP TRIGGER delete_school_year');
    }
};
