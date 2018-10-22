<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('replies'))
        {
            Schema::create('replies', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id', false, true);
                $table->integer('thread_id', false, true);
                $table->text('body');
                $table->string('created_by')->nullable();
                $table->string('updated_by')->nullable();
                $table->timestamps();
            });

            Schema::table('replies', function (Blueprint $table) {
                 $table->foreign('thread_id')->references('id')->on('threads')->onDelete('cascade');
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
}
