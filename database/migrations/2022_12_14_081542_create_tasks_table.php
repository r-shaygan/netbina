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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->timestamp('deadline');
            $table->boolean('status')->default(0);
            $table->unsignedBigInteger('owner');
            $table->unsignedBigInteger('assigned');
            $table->unsignedBigInteger('assigner');
            $table->timestamps();
            $table->foreign('owner')->on('users')->references('id');
            $table->foreign('assigned')->on('users')->references('id');
            $table->foreign('assigner')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
