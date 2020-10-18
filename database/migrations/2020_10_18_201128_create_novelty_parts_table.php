<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoveltyPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novelty_parts', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['subtitle', 'text', 'header', 'twit']);
            $table->text('content');
            $table->foreignId('novelty_id');
            $table->timestamps();

            $table->foreign('novelty_id')->references('id')->on('novelties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('novelty_parts');
    }
}
