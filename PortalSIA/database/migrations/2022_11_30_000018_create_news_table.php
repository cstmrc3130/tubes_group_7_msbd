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
        Schema::create('news', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->uuid("author_id");
            $table->tinyText("title");
            $table->text("description");
            $table->text("image");
            $table->timestamps();

            // onDelete restrict PREVENT TO DELETE users RECORD DIRECTLY IF POST IS ALREADY FILLED
            $table->foreign('author_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
};
