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
        // DB::unprepared('CREATE TRIGGER set_uuid_in_classes BEFORE INSERT ON classes FOR EACH ROW
        //     BEGIN
        //         SET NEW.id = uuid();
        //     END');

        DB::unprepared(
            'CREATE TRIGGER delete_extracurriculars BEFORE DELETE ON extracurriculars
            FOR EACH ROW BEGIN
            INSERT INTO log_extracurriculars (id, old_name, old_description, old_image)
            VALUES (uuid(), OLD.name, OLD.description, OLD.image);
        END');

        DB::unprepared('CREATE TRIGGER update_extracurriculars BEFORE UPDATE ON extracurriculars
        FOR EACH ROW BEGIN
        INSERT INTO log_extracurriculars (id, old_name, new_name, old_description, new_description, old_image, new_image)
            VALUES (uuid(), OLD.name, NEW.name, OLD.description, NEW.description, OLD.image, NEW.image);
        END');

        DB::unprepared('CREATE TRIGGER insert_extracurriculars AFTER INSERT ON extracurriculars
            FOR EACH ROW BEGIN
            INSERT INTO log_extracurriculars (id, new_name, new_description, new_image)
                VALUES (uuid(), NEW.name, NEW.description, NEW.image);
            END');
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER delete_extracurriculars');
        DB::unprepared('DROP TRIGGER update_extracurriculars');
        DB::unprepared('DROP TRIGGER insert_extracurriculars');
    }
};
