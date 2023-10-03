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
        Schema::create('barber_shop_profissional', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('profissional')->unsigned();
            $table->bigInteger('barber_shop')->unsigned();
            $table->timestamps();

            $table->foreign('profissional')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('barber_shop')->references('id')->on('barber_shops')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barber_shop_profissional');
    }
};
