<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spot', function (Blueprint $table) {
            $table->id();
            $table->integer('spot_id');
            $table->integer('bcn_id');
            $table->string('station_id', 4);
            $table->integer('floor_id');
            $table->string('spot_name', 40);
            $table->string('list_image', 255);
            $table->text('spot_excerpt');
            $table->text('spot_description');
            $table->string('spot_image1', 255);
            $table->string('spot_image2', 255);
            $table->string('spot_image3', 255);
            $table->string('spot_image4', 255);
            $table->string('spot_image5', 255);
            $table->string('spot_voice', 255);
            $table->string('spot_mov_file', 255);
            $table->char('status', 1)->nullable()->default(0);
            $table->integer('order')->nullable()->default(0);
            $table->dateTime('valid_at');
            $table->string('mod_user', 190);
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
        Schema::dropIfExists('spot');
    }
}
