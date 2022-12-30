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
        Schema::create('log_classes', function (Blueprint $table) {
            $table->uuid('id');
            $table->tinyText("old_name");
            $table->tinyText("new_name");
            $table->uuid('old_school_year_id');
            $table->uuid('new_school_year_id');
            $table->tinyInteger("old_semester");
            $table->tinyInteger("new_semester");
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