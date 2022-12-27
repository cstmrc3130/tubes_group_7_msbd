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
        Schema::create('absent_recapitulations', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->char("NISN", 10);
            $table->uuid("school_year_id");
            $table->enum("type", ['S', 'A', 'I']);
            $table->date('date');
            $table->timestamps();

            // FOREIGN KEY
            $table->foreign('NISN')->references('NISN')->on('students')->onDelete('restrict')->onUpdate('cascade');
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
        //
    }
};
