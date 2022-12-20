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
        // create account teachers to users
        DB::unprepared(
            'CREATE TRIGGER create_new_account_teachers AFTER INSERT ON teachers
            FOR EACH ROW BEGIN   
               INSERT INTO users(id, NIP, PASSWORD, role, 
               profile_picture) VALUES (uuid(), NEW.NIP,
               "$2a$12$HXA488uKmhQmJJa3zQKxC.J41vmu8g.PSKovhfEIqICc4DexC.CB.",
               "1","DEFAULT");
           END'
        );
        // trigger insert
        DB::unprepared(
            'CREATE TRIGGER insert_log_teachers AFTER INSERT ON teachers
            FOR EACH ROW BEGIN
               INSERT INTO log_teachers(id, new_name, new_position, new_place_of_birth, new_date_of_birth, new_address, new_phone_numbers, type)
               VALUES(uuid(), NEW.name, NEW.position, NEW.place_of_birth,  
               NEW.date_of_birth, NEW.address, NEW.phone_numbers, "i");
               END'
        );
        // trigger update
        DB::unprepared(
            'CREATE TRIGGER update_log_teachers BEFORE UPDATE ON teachers
            FOR EACH ROW BEGIN
               INSERT INTO log_teachers(id, old_name, new_name, old_position, new_position, old_place_of_birth, new_place_of_birth, old_date_of_birth, new_date_of_birth, old_address, new_address, old_phone_numbers, new_phone_numbers, type)
               VALUES(uuid(), OLD.name, NEW.name, OLD.position, NEW.position, OLD.place_of_birth, IF(NEW.place_of_birth IN (OLD.place_of_birth), '-', NEW.place_of_birth), OLD.date_of_birth, 
           NEW.date_of_birth, OLD.address, IF(NEW.address IN (OLD.address), '-', NEW.address), OLD.phone_numbers, NEW.phone_numbers, "u");
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
        DB::unprepared('DROP TRIGGER create_new_account_students');
        DB::unprepared('DROP TRIGGER insert_log_teachers');
        DB::unprepared('DROP TRIGGER update_log_teachers');
    }
};
