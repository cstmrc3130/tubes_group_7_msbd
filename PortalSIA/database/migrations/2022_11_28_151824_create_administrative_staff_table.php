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
        Schema::create('administrative_staff', function (Blueprint $table) {
            $table->uuid("user_id")->primary();
            $table->char("NIP", 18);
            $table->char("KARPEG")->nullable();
            $table->string("name");
            $table->char("place_of_birth");
            $table->date("date_of_birth");
            $table->date("started_working_at");
            $table->char("subject_id");
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
        Schema::dropIfExists('administrative_staff');
    }
};
