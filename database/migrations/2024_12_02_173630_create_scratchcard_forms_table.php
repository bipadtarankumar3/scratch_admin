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
        Schema::create('scratchcard_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->text('schreenshot')->nullable();
            $table->string('scratchcard_id')->nullable();
            $table->string('camping_id')->nullable();
            $table->string('bike_model_id')->nullable();
            $table->string('mac_address')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('scratchcard_forms');
    }
};
