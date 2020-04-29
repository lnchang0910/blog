<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('station_id', 4);
            $table->integer('news_type');
            $table->string('news_title', 120);
            $table->text('news_excerpt')->nullable();
            $table->text('news_content')->nullable();
            $table->string('news_date')->nullable()->default('');
            $table->string('news_location', 120)->nullable()->default('');
            $table->string('news_dept', 120)->nullable()->default('');
            $table->string('news_cate', 120)->nullable()->default('');
            $table->text('news_remark')->nullable();
            $table->string('news_image', 50)->nullable()->default('');
            $table->char('on_main_page', 1)->nullable()->default(0);
            $table->char('on_index', 1)->nullable()->default(0);
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
        Schema::dropIfExists('news');
    }
}
