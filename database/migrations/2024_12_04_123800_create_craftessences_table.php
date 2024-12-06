<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCraftessencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('craftessences', function (Blueprint $table) {
            $table->id();
            $table->string('name_ce')->unique();
            $table->integer('rarity_ce')->unsigned();
            $table->integer('max_level_ce')->unsigned();
            $table->integer('base_attack_ce')->unsigned();
            $table->integer('base_hp_ce')->unsigned();
            $table->json('effects_ce')->nullable(); 
            $table->string('img_ce')->nullable(); 
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
        Schema::dropIfExists('craftessences');
    }
}