<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSceneryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scenery', function (Blueprint $table) {
            $table->id();
            $table->string('station_code', 4);
            $table->integer('scn_id');
            $table->string('scn_title', 30);
            $table->text('scn_excerpt');
            $table->string('list_image', 30);
            $table->text('scn_content');
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
        Schema::dropIfExists('scenery');
    }
}
