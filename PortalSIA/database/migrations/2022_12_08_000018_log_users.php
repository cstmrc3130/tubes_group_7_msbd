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
        Schema::create('log_users', function (Blueprint $table) {
            $table->uuid('id');
            $table->string("old_email")->nullable();
            $table->string("new_email")->nullable();
            $table->string('old_password');
            $table->string('new_password');
            $table->enum("old_role", [0, 1, 2]);
            $table->enum("new_role", [0, 1, 2]);
            $table->tinyText("old_profile_picture");
            $table->tinyText("new_profile_picture");
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
