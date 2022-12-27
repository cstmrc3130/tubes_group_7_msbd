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
        Schema::create('log_teachers', function (Blueprint $table) {
            $table->uuid("id");
            $table->tinyText("old_name");
            $table->tinyText("new_name");
            $table->tinyText("old_position");
            $table->tinyText("new_position");
            $table->tinyText("old_place_of_birth");
            $table->tinyText("new_place_of_birth");
            $table->date("old_date_of_birth");
            $table->date("new_date_of_birth");
            $table->enum("old_gender", ["M", "F"])->nullable();
            $table->enum("new_gender", ["M", "F"])->nullable();
            $table->text("old_address")->nullable();
            $table->text("new_address")->nullable();
            $table->string("old_phone_numbers")->nullable();
            $table->string("new_phone_numbers")->nullable();
            $table->enum('type', ['U', 'I' ,'D']);
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
        //
    }
};
