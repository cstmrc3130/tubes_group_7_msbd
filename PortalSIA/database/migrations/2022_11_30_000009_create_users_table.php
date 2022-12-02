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
            $table->char("NIP", 18)->nullable();
            $table->char("NISN", 10)->nullable();
            $table->string("email")->nullable();
            $table->string('password');
            $table->enum("role", [0, 1, 2]);
            $table->timestamps();

            // onDelete restrict PREVENT TO DELETE users RECORD DIRECTLY IF POST IS ALREADY FILLED
            $table->foreign('NIP')->references('NIP')->on('teachers')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('NISN')->references('NISN')->on('students')->onDelete('restrict')->onUpdate('cascade');
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
