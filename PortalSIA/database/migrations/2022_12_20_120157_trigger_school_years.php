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
            'CREATE TRIGGER `update_log_school_year` BEFORE UPDATE ON `school_years`
            FOR EACH ROW BEGIN
               SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "You Can not Change it!";
               END'
        );

        DB::unprepared(
            'CREATE TRIGGER `insert_log_school_year` BEFORE INSERT ON `school_years`
            FOR EACH ROW BEGIN	
               INSERT INTO log_school_years (
                   id, new_year)
                   VALUES (uuid(), NEW.year);
                   END'
          );

        DB::unprepared(
            'CREATE TRIGGER `delete_log_school_year` BEFORE DELETE ON `school_years`
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
        DB::unprepared('DROP TRIGGER update_log_school_year');
        DB::unprepared('DROP TRIGGER insert_log_school_year');
        DB::unprepared('DROP TRIGGER delete_log_school_year');
    }
};
