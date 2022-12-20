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
        // Update  users
        DB::unprepared(
            'CREATE TRIGGER update_log_users BEFORE UPDATE ON users
            FOR EACH ROW BEGIN	
               INSERT INTO log_users ( id, old_email, new_email, 	     
                                      old_password, new_password, 
                                      old_profile_picture, 
                                      new_profile_picture, type)
                              VALUES  (uuid(), OLD.email, NEW.email, 
                                       OLD.password, NEW.password, 
                                       OLD.profile_picture, 
                                       NEW.profile_picture, "u");
                              END'
        );
        // insert users
        DB::unprepared(
            'CREATE TRIGGER insert_log_users BEFORE INSERT ON users
            FOR EACH ROW BEGIN	
               INSERT INTO log_users ( id, new_email, 	     
                                       new_password, new_profile_picture, type)
                              VALUES  (uuid(), NEW.email, 
                                       NEW.password, 
                                       NEW.profile_picture, "i");
                              END'
        );
        //delete users
        DB::unprepared(
            'CREATE TRIGGER delete_log_users BEFORE DELETE ON users
            FOR EACH ROW BEGIN
           SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "YOU CAN NOT DELETE IT";
           END'
        );

        DB::unprepared(
            'CREATE TRIGGER set_uuid_in_users BEFORE INSERT ON users
            FOR EACH ROW BEGIN
            SET NEW.id = uuid();
            END
            ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER update_log_users');
        DB::unprepared('DROP TRIGGER insert_log_users');
        DB::unprepared('DROP TRIGGER delete_log_users');
        DB::unprepared('DROP TRIGGER set_uuid_in_users');
    }
};
