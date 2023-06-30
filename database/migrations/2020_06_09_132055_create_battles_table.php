<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBattlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('battles', function (Blueprint $table) {
            $table->id();
            $table->string('title',100)->nullable();
            $table->text('description')->nullable();
            $table->integer('gap')->nullable();
            $table->integer('creator_id');
            $table->integer('assignee_id');
            $table->integer('rounds')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->dateTime('time')->nullable();
            $table->json('video_options')->nullable();
            $table->enum('current_status', ['none','creator','joiner','both','live','ended'])->default('none');
            $table->json('current_round')->nullable();
            $table->string('secret');
            $table->enum('status', [0,1])->default(1);
            $table->enum('verified', [0,1])->default(0);
            $table->integer('category_id')->unsigned();
            $table->string('views')->nullable();
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
        Schema::dropIfExists('battles');
    }
}
