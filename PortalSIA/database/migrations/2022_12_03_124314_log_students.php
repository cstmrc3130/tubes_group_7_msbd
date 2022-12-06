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
        
        Schema::create('log_students', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->tinyText("old_name");
            $table->tinyText("new_name");
            $table->tinyText("old_place_of_birth");
            $table->tinyText("new_place_of_birth");
            $table->date("old_date_of_birth");
            $table->date("new_date_of_birth");
            $table->text("old_address");
            $table->text("new_address");
            $table->string("old_phone_numbers")->nullable();
            $table->string("new_phone_numbers")->nullable();
            $table->enum('type', ['u', 'i' ,'d']);
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
