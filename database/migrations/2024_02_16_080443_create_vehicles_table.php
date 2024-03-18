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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->string('vehicle_id');
            $table->string('vehicle_name');
            $table->longtext('vehicle_img');
            $table->string('company');
            $table->string('model');
            $table->string('bag');
            $table->year('years');
            $table->integer('seat');
            $table->string('ac');
            $table->enum('status', ['Available', 'Not Available', NULL])->default('Available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
