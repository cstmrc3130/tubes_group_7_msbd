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
        DB::statement("CREATE VIEW view_teacher_extracurricular AS
        SELECT teachers.NIP, teachers.name,teaching_extracurriculars.extracurricular_id extracurriculars.name
        FROM teachers, extracurriculars, teaching_extracurriculars
        WHERE teachers.NIP=teaching_extracurriculars.NIP, teaching_extracurriculars.extracurricular_id=extracurriculars.id;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_teacher_extracurricular");
    }
};
