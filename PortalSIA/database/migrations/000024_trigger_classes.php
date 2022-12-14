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
            'CREATE TRIGGER delete_classes AFTER DELETE ON classes
            FOR EACH ROW BEGIN
            SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "YOU CANT CHANGE CONTAIN IN THIS CLASS";
        END');

        DB::unprepared('CREATE TRIGGER update_classes BEFORE UPDATE ON classes
        FOR EACH ROW BEGIN
        SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "YOU CANT CHANGE CONTAIN IN THIS CLASS";
        END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER delete_classes');
        DB::unprepared('DROP TRIGGER update_classes');
    }
};
