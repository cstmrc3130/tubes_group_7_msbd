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
        Schema::create('teachers', function (Blueprint $table) {
            $table->char("NIP", 18)->primary();
            $table->char("KARPEG");
            $table->tinyText("position");
            $table->tinyText("name");
            $table->tinyText("place_of_birth")->nullable();
            $table->date("date_of_birth")->nullable();
            $table->enum("gender", ["M", "F"])->nullable();
            $table->text("address")->nullable();
            $table->string("phone_numbers")->nullable();
            $table->tinyText("graduated_from");
            $table->smallInteger("graduated_at");
            $table->smallInteger("started_working_at");
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
        Schema::dropIfExists('teachers');
    }
};

