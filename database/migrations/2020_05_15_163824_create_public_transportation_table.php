<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicTransportationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_transportation', function (Blueprint $table) {
            $table->id();
            $table->string('station_id', 4);
            $table->string('location_image', 256)->nullable();
            $table->text('thsrc')->nullable();
            $table->text('railway')->nullable();
            $table->string('bus')->nullable();
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
        Schema::dropIfExists('public_transportation');
    }
}
