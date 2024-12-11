<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('servants', function (Blueprint $table) {
            $table->id();
            $table->string('name_sv')->unique();
            $table->string('class_sv');
            $table->integer('rarity_sv');
            $table->integer('base_hp_sv');
            $table->integer('base_atk_sv');
            $table->string('img_sv')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('servants');
    }
};