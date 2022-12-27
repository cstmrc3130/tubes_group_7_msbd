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
        Schema::create('teacher_homeroom_classes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char("NIP", 18);
            $table->uuid("school_year_id");
            $table->uuid("homeroom_class_id");
            $table->timestamps();

            // FOREIGN KEY
            $table->foreign('NIP')->references('NIP')->on('teachers')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('school_year_id')->references('id')->on('school_years')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('homeroom_class_id')->references('id')->on('classes')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homeroom_classes');
    }
};
