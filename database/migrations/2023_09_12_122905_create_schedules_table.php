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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('barber_shop')->unsigned();
            $table->bigInteger('client')->unsigned();
            $table->bigInteger('barber')->unsigned();
            $table->date('date');
            $table->time('hour');
            $table->bigInteger('status')->unsigned();
            $table->timestamps();

            $table->foreign('barber_shop')->references('id')->on('barber_shops')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('client')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('barber')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('status')->references('id')->on('schedule_status')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
