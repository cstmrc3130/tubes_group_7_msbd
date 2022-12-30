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
        DB::unprepared('
        CREATE PROCEDURE get_female_students()
        BEGIN
        SELECT NISN, name, gender, description FROM students
        WHERE gender = "F";
        END;');

        DB::unprepared('
        CREATE PROCEDURE get_male_students()
        BEGIN
        SELECT NISN, name, gender, description FROM students
        WHERE gender = "M";
        END;');

        // DB::unprepared('
        // CREATE PROCEDURE get_seventh_grades()
        // BEGIN
        // SELECT  * FROM classes
        // WHERE name LIKE "7%";
        // END;');

        // DB::unprepared('
        // CREATE PROCEDURE get_eighth_grades()
        // BEGIN
        // SELECT  * FROM classes
        // WHERE name LIKE "8%";
        // END;');        

        // DB::unprepared('
        // CREATE PROCEDURE get_ninth_grades()
        // BEGIN
        // SELECT  * FROM classes
        // WHERE name LIKE "9%";
        // END;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('get_female_students()');
        DB::unprepared('get_male_students()');
        // DB::unprepared('get_seventh_grades()');
        // DB::unprepared('get_eighth_grades()');
        // DB::unprepared('get_ninth_grades()');
    }
};
