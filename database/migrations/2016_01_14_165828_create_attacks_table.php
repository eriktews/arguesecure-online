<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attacks', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');

            $table->string('description');
            
            $table->text('text');

            $table->integer('risk_id')->unsigned()->nullable();
            $table->foreign('risk_id')->references('id')->on('risks')->onDelete('cascade');

            $table->tinyInteger('locked');
            
            $table->bigInteger('lock_time')->unsigned();

            $table->timestamps();

            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attacks');
    }
}
