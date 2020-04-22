<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('station', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('area_id');
            $table->string('station_code', 4);
            $table->string('station_name', 40);
            $table->string('address', 120);
            $table->string('telno', 30);
            $table->text('remark');
            $table->text('footer');
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
        Schema::dropIfExists('station');
    }
}
