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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->foreignId('pickup_office_id')->constrained('offices')->onDelete('cascade');
            $table->foreignId('return_office_id')->constrained('offices')->onDelete('cascade');
            $table->string('booking_code')->unique();
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->datetime('pickup_date')->nullable();
            $table->datetime('return_date')->nullable();
            $table->decimal('subtotal_amount', 10, 2);
            $table->decimal('tax_amount', 10, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2);
            $table->decimal('daily_rate', 10, 2);
            $table->integer('days');
            $table->decimal('tax_percentage', 5, 2)->default(0);
            $table->decimal('discount_percentage', 5, 2)->default(0);
            $table->enum('status', ['pending', 'approved', 'active', 'returned', 'cancelled', 'expired'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
