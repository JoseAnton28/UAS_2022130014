<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('character_planner_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('character_planner_id');
            $table->unsignedBigInteger('material_id');
            $table->integer('quantity')->default(1);
            $table->timestamps();

            $table->foreign('character_planner_id')->references('id')->on('character_planners')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('character_planner_materials');
        Schema::dropIfExists('character_planners');
    }
};
