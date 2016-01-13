<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRisksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risks', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');

            $table->string('description');
            
            $table->text('text');

            $table->integer('tree_id')->unsigned()->nullable();
            $table->foreign('tree_id')->references('id')->on('trees')->onDelete('cascade');

            $table->boolean('locked');

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
        Schema::drop('risks');
    }
}
