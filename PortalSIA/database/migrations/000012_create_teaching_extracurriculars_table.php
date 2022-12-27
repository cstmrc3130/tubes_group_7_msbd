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
        Schema::create('teaching_extracurriculars', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->char("NIP", 18);
            $table->uuid("extracurricular_id");
            $table->timestamps();

            // FOREIGN KEY
            $table->foreign('NIP')->references('NIP')->on('teachers')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('teaching_extracurriculars');
    }
};
