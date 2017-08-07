<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_id');
            $table->string('name');
            $table->timestamps();
            $table->unique(['app_id', 'name']);
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->foreign('app_id', 'app_tag_id_foreign')
                ->references('id')->on('apps')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
