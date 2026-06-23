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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fleet_id')->constrained();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('license_number')->unique();
            $table->date('license_expiry');
            $table->enum('status', ['available', 'assigned', 'off_duty'])->default('available');
            $table->decimal('rating', 3, 2)->default(5.00); // Driver performance rating
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
