<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrawledDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crawled_data', function (Blueprint $table) {
            $table->id();
            $table->string('url'); // The crawled URL
            $table->json('links')->nullable(); // Links as JSON
            $table->json('headings')->nullable(); // Headings as JSON
            $table->json('paragraphs')->nullable(); // Paragraphs as JSON
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
        Schema::dropIfExists('crawled_data');
    }
}
