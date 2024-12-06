<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('materials', function (Blueprint $table) {
        $table->id();
        $table->string('name_mt');
        $table->string('type_mt');
        $table->string('drop_location_mt')->nullable();
        $table->string('img_mt')->nullable();
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('materials');
    }
};