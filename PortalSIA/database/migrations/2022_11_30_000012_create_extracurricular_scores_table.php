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
        Schema::create('extracurricular_scores', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->char("NISN", 10);
            $table->uuid("extracurricular_id");
            $table->double("score");
            $table->timestamps();

            // FOREIGN KEY
            $table->foreign('NISN')->references('NISN')->on('students')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('extracurricular_id')->references('id')->on('extracurriculars')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extracurricular_scores');
    }
};
