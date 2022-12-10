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
        DB::statement("CREATE VIEW view_students_extracurricular AS
        SELECT students.NISN, students.name, extracurricular_scores.extracurricular_id, extracurriculars.name
        FROM students, extracurricular_scores, extracurriculars
        WHERE students.NISN=extracurricular_scores.NISN, extracurricular_scores.extracurricular_id=extracurriculars.id;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_students_extracurricular");
    }
};
