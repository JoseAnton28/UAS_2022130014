<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeambuilderServantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teambuilder_servants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teambuilder_id');
            $table->unsignedBigInteger('servant_id');
            $table->unsignedBigInteger('craftessence_id');
            $table->timestamps();

            
            $table->foreign('teambuilder_id')->references('id')->on('teambuilders')->onDelete('cascade');
            $table->foreign('servant_id')->references('id')->on('servants')->onDelete('cascade');
            $table->foreign('craftessence_id')->references('id')->on('craftessences')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teambuilder_servants');
    }
}
