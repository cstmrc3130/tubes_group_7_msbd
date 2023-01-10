<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DB::unprepared('CREATE TRIGGER set_uuid_in_classes BEFORE INSERT ON classes FOR EACH ROW
        //     BEGIN
        //         SET NEW.id = uuid();
        //     END');

        DB::unprepared(
            'CREATE TRIGGER delete_news BEFORE DELETE ON news
            FOR EACH ROW BEGIN
            INSERT INTO log_news (id, old_title, old_content)
            VALUES (uuid(), OLD.title, OLD.content);
        END');

        DB::unprepared('CREATE TRIGGER update_news BEFORE UPDATE ON news
        FOR EACH ROW BEGIN
        INSERT INTO log_news (id, old_title, new_title, old_content, new_content)
            VALUES (uuid(), OLD.title, NEW.title, OLD.content, NEW.title);
        END');

        DB::unprepared('CREATE TRIGGER insert_news AFTER INSERT ON news
            FOR EACH ROW BEGIN
            INSERT INTO log_news (id, new_title, new_content)
                VALUES (uuid(), NEW.title, NEW.title);
            END');
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER delete_news');
        DB::unprepared('DROP TRIGGER update_news');
        DB::unprepared('DROP TRIGGER insert_news');
    }
};
