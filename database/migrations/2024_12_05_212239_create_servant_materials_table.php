<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('servant_material', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servant_id')->constrained()->onDelete('cascade'); // Foreign key to the servant
            $table->foreignId('material_id')->constrained()->onDelete('cascade'); // Foreign key to the material
            $table->integer('amount'); // The amount of material
            $table->integer('ascension_level')->nullable(); // The ascension level
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('servant_material');
    }
};

