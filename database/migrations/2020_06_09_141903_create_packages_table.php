<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->json('title')->nullable();
            $table->double('price', 7, 2);
            $table->integer('period')->nullable();
            $table->string('type', 50)->nullable();
            $table->string('description')->nullable();
            $table->enum('package_for', ['users', 'players'])->nullable();
            $table->enum('status',[0, 1])->default(1);
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
        Schema::dropIfExists('packages');
    }
}
