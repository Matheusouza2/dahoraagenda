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
        Schema::create('schedule_closes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('barber_shop')->unsigned();
            $table->dateTime('date');
            $table->string('reason')->nullable()->default('');
            $table->timestamps();

            $table->foreign('barber_shop')->references('id')->on('barber_shops')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_closes');
    }
};
