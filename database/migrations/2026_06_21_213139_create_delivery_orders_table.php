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
        Schema::create('delivery_orders', function (Blueprint $table) {
            $table->id();
            $table->string('do_number')->unique(); // Delivery Order unique identifier
            $table->string('recipient_name');
            $table->string('recipient_phone');
            $table->text('delivery_address');
            $table->enum('status', ['pending', 'assigned', 'in_transit', 'delivered', 'failed'])->default('pending');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('fleet_id')->nullable();
            $table->dateTime('scheduled_delivery')->nullable();
            $table->dateTime('actual_delivery')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('set null');
            $table->foreign('fleet_id')->references('id')->on('fleets')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_orders');
    }
};
