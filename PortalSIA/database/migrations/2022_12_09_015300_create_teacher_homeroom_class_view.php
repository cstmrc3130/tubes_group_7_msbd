<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        DB::statement("CREATE VIEW view_teacher_homeroom_class AS
        SELECT teachers.NIP, teachers.name, homeroom_class.class_id
        FROM teachers, homeroom_class
        WHERE teachers.NIP=homeroom_class.NIP;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_teacher_homeroom_class");
    }
};
