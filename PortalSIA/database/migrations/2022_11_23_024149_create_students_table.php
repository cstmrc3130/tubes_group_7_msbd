<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->char("NISN", 10)->primary();
            $table->string("name");
            $table->enum("gender", ["M", "F"]);
            $table->char("place_of_birth");
            $table->date("date_of_birth");
            $table->string("address");
            $table->string("phone_number")->nullable();
            $table->string("father_name")->nullable();
            $table->string("mother_name")->nullable();
            $table->string("guardian_name")->nullable();
            $table->integer("grade");
            $table->integer("entry_year");
            $table->char("homeroom_teacher_id");
            $table->char("class_id");
            $table->enum("special_needs", ['E', "NA"]);
            $table->status("status", ["A", "I"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
