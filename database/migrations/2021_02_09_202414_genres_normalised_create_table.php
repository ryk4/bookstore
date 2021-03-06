<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GenresNormalisedCreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

        Schema::create('book_genre', function (Blueprint $table) {
            //Composite key created of 2 foreign keys
            $table->foreignId('book_id')->constrained()->onDelete('Cascade');
            $table->foreignId('genre_id')->constrained();

            //$table->primary(['book_id', 'genre_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_genre');
        Schema::dropIfExists('genres');
    }
}
