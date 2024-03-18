<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTariffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tariffs', function (Blueprint $table) {
            $table->id('tariff_id');
            $table->string('tariff_name');
            $table->enum('tariff_type', ['per_hour', 'per_km', 'per_day']);
            $table->string('amount')->nullable();
            $table->string('min_km')->nullable();
            $table->string('per_km')->nullable();
            $table->string('extra_km')->nullable();
            $table->integer('seat');
            $table->string('driver_charge')->nullable();
            $table->string('expensive')->nullable();
            $table->timestamp('created_at')->useCurrent(); // Use the current timestamp
            $table->timestamp('updated_at')->nullable(); // Allow NULL for the updated_at column
            $table->enum('status', ['active', 'inactive']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tariffs');
    }
}
