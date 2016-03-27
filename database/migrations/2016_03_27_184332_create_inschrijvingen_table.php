<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInschrijvingenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inschrijvingen', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workshop')->unsigned()->nullable();
            $table->foreign('workshop')->references('id')->on('workshops')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->integer('studentnummer');
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
        Schema::drop('inschrijvingen');
    }
}
