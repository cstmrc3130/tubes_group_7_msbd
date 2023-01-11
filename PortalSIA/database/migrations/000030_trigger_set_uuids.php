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
        /*tabel absent_recapitulations*/
        DB::unprepared('CREATE TRIGGER set_uuid_in_absent_recapitulations BEFORE INSERT ON absent_recapitulations FOR EACH ROW
        BEGIN
            SET NEW.id = uuid();
        END');

        /*tabel extracurriculars*/
        DB::unprepared('CREATE TRIGGER set_uuid_in_extracurriculars BEFORE INSERT ON extracurriculars FOR EACH ROW
        BEGIN
            SET NEW.id = uuid();
        END');

        /*tabel extracurriculars_score*/
        DB::unprepared('CREATE TRIGGER set_uuid_in_extracurricular_scores BEFORE INSERT ON extracurricular_scores FOR EACH ROW
        BEGIN
            SET NEW.id = uuid();
        END');

        /*tabel news*/
        DB::unprepared('CREATE TRIGGER set_uuid_in_news BEFORE INSERT ON news FOR EACH ROW
        BEGIN
            SET NEW.id = uuid();
        END');

        /*tabel notifications*/
        DB::unprepared('CREATE TRIGGER set_uuid_in_notifications BEFORE INSERT ON notifications FOR EACH ROW
        BEGIN
            SET NEW.id = uuid();
        END');

        /*tabel scoring_sessions*/
        // DB::unprepared('CREATE TRIGGER set_uuid_in_scoring_sessions BEFORE INSERT ON scoring_sessions FOR EACH ROW
        // BEGIN
        //     SET NEW.id = uuid();
        // END');

        /*tabel subject_scores*/
        DB::unprepared('CREATE TRIGGER set_uuid_in_subject_scores BEFORE INSERT ON subject_scores FOR EACH ROW
        BEGIN
            SET NEW.id = uuid();
        END');

        /*tabel taking_extracurriculars*/
        DB::unprepared('CREATE TRIGGER set_uuid_in_taking_extracurriculars BEFORE INSERT ON taking_extracurriculars FOR EACH ROW
        BEGIN
            SET NEW.id = uuid();
        END');
        
        /*tabel teaching_extracurriculars*/
        DB::unprepared('CREATE TRIGGER set_uuid_in_teaching_extracurriculars BEFORE INSERT ON teaching_extracurriculars FOR EACH ROW
        BEGIN
            SET NEW.id = uuid();
        END');

        /*tabel teaching_subjects*/
        DB::unprepared('CREATE TRIGGER set_uuid_in_teaching_subjects BEFORE INSERT ON teaching_subjects FOR EACH ROW
        BEGIN
            SET NEW.id = uuid();
        END');

        /*student_homeroom_classes*/
        DB::unprepared('CREATE TRIGGER set_uuid_in_student_homeroom_classes BEFORE INSERT ON student_homeroom_classes FOR EACH ROW
        BEGIN
            SET NEW.id = uuid();
        END');

        /*teachers_homeroom_classes*/
        DB::unprepared('CREATE TRIGGER set_uuid_in_teacher_homeroom_classes BEFORE INSERT ON teacher_homeroom_classes FOR EACH ROW
        BEGIN
            SET NEW.id = uuid();
        END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('set_uuid_in_absent_recapitulations');
        DB::unprepared('set_uuid_in_extracurriculars');
        DB::unprepared('set_uuid_in_extracurricular_scores');
        DB::unprepared('set_uuid_in_news');
        DB::unprepared('set_uuid_in_notifications');
        // DB::unprepared('set_uuid_in_scoring_sessions');
        DB::unprepared('set_uuid_in_subject_scores');
        DB::unprepared('set_uuid_in_taking_extracurriculars');
        DB::unprepared('set_uuid_in_teaching_extracurriculars');
        DB::unprepared('set_uuid_in_teaching_subjects');
        DB::unprepared('set_uuid_in_student_homeroom_classes');
        DB::unprepared('set_uuid_in_teachers_homeroom_classes');
    }
};
