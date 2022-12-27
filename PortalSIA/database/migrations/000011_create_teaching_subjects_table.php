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
        Schema::create('teaching_subjects', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->char("NIP", 18);
            $table->uuid("subject_id");
            $table->uuid("class_id");
            $table->uuid("school_year_id");
            $table->timestamps();

            // FOREIGN KEY
            $table->foreign('NIP')->references('NIP')->on('teachers')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('school_year_id')->references('id')->on('school_years')->onDelete('restrict')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teaching_subjects');
    }
};
