<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDareRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dare_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('battle_id')->unsigned()->nullable();
            $table->integer('player_id')->unsigned()->nullable();
            $table->string('description', 500)->nullable();
            $table->double('amount', 7, 2);
            $table->enum('is_accepted',[0,1])->default(0);
            $table->enum('is_finished',[0,1])->default(0);
            $table->enum('status',[0,1])->default(1);
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
        Schema::dropIfExists('dare_requests');
    }
}
