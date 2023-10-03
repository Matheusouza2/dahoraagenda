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
        Schema::create('schedule_configs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('barber_shop')->unsigned();
            $table->integer('day');
            $table->time('hour_1')->nullable()->default(null);
            $table->time('hour_2')->nullable()->default(null);
            $table->time('hour_3')->nullable()->default(null);
            $table->time('hour_4')->nullable()->default(null);
            $table->time('hour_5')->nullable()->default(null);
            $table->time('hour_6')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('barber_shop')->references('id')->on('barber_shops')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_configs');
    }
};
