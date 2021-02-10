<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->default('Sorry, person who created this book did not provide description.');
            $table->string('cover')->nullable();//will contain url to image
            $table->double('price', 8, 2);
            $table->integer('discount');//0 - not approved, 1- approved
            $table->integer('status');//0 - not approved, 1- approved
            $table->timestamps();

            //FKS
            $table->foreignId('user_id')->constrained();
            //only works if following proper naming conventions for schema tables/columns


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
