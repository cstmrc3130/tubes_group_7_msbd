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
        Schema::create('subject_scores', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->uuid("subject_id");
            $table->char("NISN", 10);
            $table->uuid("scoring_session_id");
            $table->uuid("completeness_id");
            $table->double("score");
            $table->timestamps();

            // FOREIGN KEY
            $table->foreign('NISN')->references('NISN')->on('students')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('scoring_session_id')->references('id')->on('scoring_sessions')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_scores');
    }
};
