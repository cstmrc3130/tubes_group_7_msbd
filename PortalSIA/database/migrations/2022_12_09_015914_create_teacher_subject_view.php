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
        DB::statement("CREATE VIEW view_teachers_subject AS
        SELECT teachers.NIP, teachers.name, teaching_subjects.subject_id, subjects.name
        FROM teachers, teaching_subjects, subjects
        WHERE teachers.NIP=homeroom_class.NIP, teaching_subjects.subject_id=subjects.id;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_teacher_subject");
    }
};
