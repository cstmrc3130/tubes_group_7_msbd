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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('NIP', 18)->nullable();
            $table->char('NISN', 10)->nullable();

            // onDelete restrict PREVENT TO DELETE users RECORD DIRECTLY IF PROFILE IS ALREADY FILLED
            $table->foreign('NISN')->references('NISN')->on('students')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('NIP')->references('NIP')->on('teachers')->onDelete('restrict')->onUpdate('cascade');
            $table->string('password');
            $table->enum("role", ["admin", "teacher", "student"]);
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
        Schema::dropIfExists('users');
    }
};
