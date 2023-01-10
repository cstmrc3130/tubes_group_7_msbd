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

        DB::unprepared('CREATE TRIGGER delete_log_classes BEFORE DELETE ON log_classes FOR EACH ROW
            BEGIN
                SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "YOU CAN NOT DELETE IT!";
            END');

        DB::unprepared('CREATE TRIGGER update_log_classes BEFORE UPDATE ON log_classes FOR EACH ROW
        BEGIN
            SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "YOU CAN NOT CHANGE IT!";
        END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER delete_log_classes');
        DB::unprepared('DROP TRIGGER update_log_classes');

    }
};
