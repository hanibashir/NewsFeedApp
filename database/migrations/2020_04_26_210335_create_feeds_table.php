<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeds', function (Blueprint $table) {
            $table->id();
            $table->string('url')->nullable();
            $table->string('feed_name')->nullable();
            $table->string('logo')->nullable();
            $table->integer('category_id')->default(0);
            $table->integer('items_limit')->default(0);
            $table->boolean('cron_update')->default(false);
            $table->integer('update_rate')->default(0);
            $table->integer('last_update')->default(0);
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
        Schema::dropIfExists('feeds');
    }
}
