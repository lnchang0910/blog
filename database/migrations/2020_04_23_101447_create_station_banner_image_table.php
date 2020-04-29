<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationBannerImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('station_banner_image', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('station_id');
            $table->string('image', '60');
            $table->string('url', '255')->nullable();
            $table->integer('order');
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
        Schema::dropIfExists('station_banner_image');
    }
}
