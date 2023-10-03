<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->double('value', 15, 2);
            $table->string('image');
            $table->bigInteger('barber_shop')->unsigned();
            $table->time('duration')->nullable()->default('00:30:00');
            $table->timestamps();

            $table->foreign('barber_shop')->references('id')->on('barber_shops')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
