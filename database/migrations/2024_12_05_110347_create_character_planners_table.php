<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterPlannersTable extends Migration
{
    public function up()
    {
        Schema::create('character_planners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('servant_id')->constrained()->onDelete('cascade');
            $table->text('materials'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('character_planners');
    }
}



