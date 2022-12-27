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
            $table->tinyText("name");
            $table->tinyText("place_of_birth");
            $table->date("date_of_birth");
            $table->enum("gender", ["M", "F"]);
            $table->text("address");
            $table->string("phone_numbers")->nullable();
            $table->tinyText("father_name")->nullable();
            $table->tinyText("mother_name")->nullable();
            $table->tinyText("guardian_name")->nullable();
            $table->integer("entry_year");
            $table->enum("special_needs", ['E', "NE"])->nullable();
            $table->enum("status", ["A", "I"]);
            $table->tinyText("description");
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
