<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AuthorsNormalisedCreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
        });

        Schema::create('author_book', function (Blueprint $table) {
            //Composite key created of 2 foreign keys
            $table->foreignId('author_id')->constrained();
            $table->foreignId('book_id')->constrained()->onDelete('Cascade');

            //$table->primary(['book_id', 'author_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('author_book');
        Schema::dropIfExists('authors');

    }
}
