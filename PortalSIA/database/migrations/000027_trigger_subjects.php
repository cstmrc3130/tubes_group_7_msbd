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
        DB::unprepared('CREATE TRIGGER set_uuid_in_subjects BEFORE INSERT ON subjects FOR EACH ROW
        BEGIN
            SET NEW.id = uuid();
        END');

        DB::unprepared('CREATE TRIGGER update_subjects BEFORE UPDATE ON subjects FOR EACH ROW
        BEGIN
            SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "YOU CAN NOT CHANGE IT!";
        END');

        DB::unprepared('CREATE TRIGGER delete_subjects BEFORE DELETE ON subjects FOR EACH ROW
        BEGIN
            SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "YOU CAN NOT DELETE IT!";
        END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('set_uuid_in_subjects');
        DB::unprepared('update_subjects');
        DB::unprepared('delete_subjects');
    }
};
