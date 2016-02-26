<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('defences', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');

            $table->string('description');
            
            $table->text('text');

            $table->integer('tree_id')->unsigned()->nullable()->index();
            $table->foreign('tree_id')->references('id')->on('trees')->onDelete('cascade');

            $table->tinyInteger('is_transfer')->unsigned();

            $table->tinyInteger('locked');
            
            $table->bigInteger('lock_time')->unsigned();

            $table->timestamps();

            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('attack_defence', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('defence_id')->unsigned()->nullable()->index();
            $table->foreign('defence_id')->references('id')->on('defences')->onDelete('cascade');
            
            $table->integer('attack_id')->unsigned()->nullable()->index();
            $table->foreign('attack_id')->references('id')->on('attacks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attack_defence');
        Schema::drop('defences');
    }
}
