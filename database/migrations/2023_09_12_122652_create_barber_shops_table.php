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
        Schema::create('barber_shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('phone');
            $table->bigInteger('whatsapp')->nullable()->default(0);
            $table->boolean('type')->nullable()->default(true)->comment('TRUE = Barber, FALSE = Salon');
            $table->string('logo');
            $table->bigInteger('owner')->unsigned();
            $table->timestamps();

            $table->foreign('owner')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barber_shops');
    }
};
