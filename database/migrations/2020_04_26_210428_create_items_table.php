<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('description')->nullable();
            $table->integer('category_id')->default(0);
            $table->integer('feed_id')->default(0);
            $table->integer('hits')->default(0);
            $table->boolean('published')->default(false);
            $table->integer('datetime')->default(0);
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
        Schema::dropIfExists('items');
    }
}
