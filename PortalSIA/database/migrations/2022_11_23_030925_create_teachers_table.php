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
            $table->uuid()->primary();
            $table->char("NIP")->nullable();
            $table->char("KARPEG")->nullable();
            $table->string("name");
            $table->char("place_of_birth");
            $table->date("date_of_birth");
            $table->date("started_working_at");
            $table->boolean("isHomeroomTeacher")->default(false);
            $table->char("subject_id");
            $table->char("class_id");
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
