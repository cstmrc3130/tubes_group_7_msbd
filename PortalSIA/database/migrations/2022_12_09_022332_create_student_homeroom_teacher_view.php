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
        DB::statement("CREATE VIEW view_student_homeroom_teacher AS
        SELECT students.NISN, students.name, teachers.name,
        FROM students, teachers
        WHERE students.homeroom_teacher_NIP=teacher.NIP;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_student_homeroom_teacher");
    }
};
