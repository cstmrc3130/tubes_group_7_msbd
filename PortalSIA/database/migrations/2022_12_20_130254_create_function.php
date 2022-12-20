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
        CREATE FUNCTION assignRole (role VARCHAR(255)) RETURNS VARCHAR(255)
        BEGIN
            DECLARE result VARCHAR(255);
            IF role = "0" THEN
            SET result = "Admin";
            ELSEIF role = "1" THEN
            SET result = "Guru";
            ELSE
            SET result = "Siswa";
            END IF;
            RETURN result;
            END;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('assignRole');
    }
};
