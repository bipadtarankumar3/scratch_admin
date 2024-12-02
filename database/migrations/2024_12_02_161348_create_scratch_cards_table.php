<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scratch_cards', function (Blueprint $table) {
            $table->id();
            $table->string('camping_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('card_image')->nullable();
            $table->string('image')->nullable();
            $table->string('color')->nullable();
            $table->string('price')->nullable();
            $table->string('no_of_time_scratch')->nullable();
            $table->string('order')->nullable();
            $table->string('card_status')->nullable();
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('scratch_cards');
    }
};
