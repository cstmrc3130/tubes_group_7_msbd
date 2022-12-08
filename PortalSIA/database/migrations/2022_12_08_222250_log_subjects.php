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
        Schema::create('log_subjects', function (Blueprint $table) {
            $table->uuid('id');
            $table->tinyText("old_name");
            $table->tinyText("new_name");
            $table->tinyInteger('old_completeness');
            $table->tinyInteger('new_completeness');
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
