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
        Schema::create('log_extracurriculars', function (Blueprint $table) {
            $table->uuid("id");
            $table->tinyText("old_name");
            $table->tinyText("new_name");
            $table->text("old_description");
            $table->text("new_description");
            $table->text("old_image");
            $table->text("new_image");
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
