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
            'CREATE TRIGGER update_students BEFORE UPDATE ON students
            FOR EACH ROW BEGIN
               INSERT INTO log_students(id, old_name, new_name, old_place_of_birth, new_place_of_birth, old_date_of_birth, 
               new_date_of_birth, old_address, new_address, old_phone_numbers, new_phone_numbers, type)
               VALUES(uuid(), OLD.name, NEW.name, OLD.place_of_birth, IF(NEW.place_of_birth IN (OLD.place_of_birth), "-",
                NEW.place_of_birth), OLD.date_of_birth, NEW.date_of_birth, OLD.address, IF(NEW.address IN (OLD.address), "-", 
                NEW.address), OLD.phone_numbers, NEW.phone_numbers, "u");
               END'
        );

        DB::unprepared(
            'CREATE TRIGGER insert_students AFTER INSERT ON students
            FOR EACH ROW BEGIN
            INSERT INTO log_students(id, new_name, new_place_of_birth, new_date_of_birth, new_address, new_phone_numbers, type)
            VALUES(uuid(), NEW.name, NEW.place_of_birth, NEW.date_of_birth, NEW.address, NEW.phone_numbers, "i");
            END'
        );

        DB::unprepared(
            'CREATE TRIGGER create_new_account_students AFTER INSERT ON students
            FOR EACH ROW BEGIN   
            INSERT INTO users(id, NISN, PASSWORD, role, 
            profile_picture) VALUES (uuid(), NEW.NISN,
            "$2a$12$VWXz3srRlDD2DQ5zLw9ZKezwVgXwInQicrMnbrjcSn9aY0WNJDBMe",
            "2","DEFAULT");
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
        DB::unprepared('DROP TRIGGER update_students');
        DB::unprepared('DROP TRIGGER insert_students');
        DB::unprepared('DROP TRIGGER create_new_account_students');
    }
};
