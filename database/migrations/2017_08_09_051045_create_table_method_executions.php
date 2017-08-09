<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMethodExecutions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('method_executions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('method_id');
            $table->boolean('success');
            $table->text('message');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('method_executions', function (Blueprint $table) {
            $table->foreign('method_id', 'method_method_executions_id_foreign')
                ->references('id')->on('methods')
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
        Schema::dropIfExists('method_executions');
    }
}
