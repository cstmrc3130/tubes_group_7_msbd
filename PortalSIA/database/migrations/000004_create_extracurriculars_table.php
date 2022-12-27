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
        Schema::create('extracurriculars', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->uuid("school_year_id");
            $table->tinyText("name");
            $table->text("description");
            $table->text("image");
            $table->timestamps();

            // FOREIGN KEY
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
        Schema::dropIfExists('extracurriculars');
    }
};
