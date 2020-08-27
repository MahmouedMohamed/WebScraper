<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeWebsiteDOMsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websiteDOMs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('website_id');
            $table->string('article_main_DOM');
            $table->string('article_title_DOM');
            $table->string('article_description_DOM');
            $table->string('article_date_DOM')->nullable();
            $table->string('article_link_DOM');

            $table->foreign('website_id')
                ->references('id')
                ->on('websites')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('websiteDOMs');
    }
}
