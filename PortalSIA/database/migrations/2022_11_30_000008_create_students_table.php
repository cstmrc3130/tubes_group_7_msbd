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
            $table->uuid("homeroom_class_id");
            $table->uuid("homeroom_teacher_NIP");
            $table->uuid("parent_id")->nullable();
            $table->uuid("guardian_id")->nullable();
            $table->tinyText("name");
            $table->tinyText("place_of_birth");
            $table->date("date_of_birth");
            $table->enum("gender", ["M", "F"]);
            $table->text("address");
            $table->string("phone_numbers")->nullable();
            $table->integer("grade");
            $table->integer("entry_year");
            $table->enum("special_needs", ['E', "NE"])->nullable;
            $table->enum("status", ["A", "I"]);
            $table->timestamps();

            // FOREIGN KEY
            $table->foreign('homeroom_class_id')->references('id')->on('classes')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('homeroom_teacher_NIP')->references('NIP')->on('teachers')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('parent_id')->references('id')->on('parents')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('guardian_id')->references('id')->on('guardians')->onDelete('restrict')->onUpdate('cascade');
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
