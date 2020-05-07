<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeaconTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beacon', function (Blueprint $table) {
            $table->id();
            $table->integer('bcn_id');
            $table->string('bcn_uuid', 256);
            $table->string('bcn_macid', 256);
            $table->integer('bcn_major');
            $table->integer('bcn_minor');
            $table->double('bcn_rssi');
            $table->string('bcn_name', 256);
            $table->integer('status');
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
        Schema::dropIfExists('beacon');
    }
}
