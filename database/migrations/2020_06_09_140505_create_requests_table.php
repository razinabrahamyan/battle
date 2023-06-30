<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->integer('battle_id')->unsigned()->nullable();
            $table->integer('creator_id')->unsigned()->nullable();
            $table->integer('assignee_id')->unsigned()->nullable();
            $table->integer('reason_id')->unsigned()->nullable();
            $table->date('request_timeout')->nullable();
            $table->enum('answer',['accepted','rejected','correction','final'])->nullable();
            $table->json('correction')->nullable();
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
        Schema::dropIfExists('requests');
    }
}
