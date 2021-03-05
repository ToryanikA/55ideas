<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStuffPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stuff_properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stuff_id');
            $table->unsignedBigInteger('property_id');
            $table->string('value');
            $table->timestamps();

            $table->foreign('stuff_id')->references('id')
                ->on('stuffs')->onDelete('cascade');
            $table->foreign('property_id')->references('id')
                ->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stuff_properties', function (Blueprint $table) {
            $table->dropForeign(['stuff_id']);
            $table->dropForeign(['property_id']);
        });
        Schema::dropIfExists('stuff_properties');
    }
}
