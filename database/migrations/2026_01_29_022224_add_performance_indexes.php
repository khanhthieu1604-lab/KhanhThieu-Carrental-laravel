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
        // Bookings table indexes
        Schema::table('bookings', function (Blueprint $table) {
            $table->index(['user_id', 'status'], 'idx_bookings_user_status');
            $table->index(['vehicle_id', 'start_date', 'end_date'], 'idx_bookings_vehicle_dates');
            $table->index('created_at', 'idx_bookings_created');
            $table->index('status', 'idx_bookings_status');
        });

        // Vehicles table indexes
        Schema::table('vehicles', function (Blueprint $table) {
            $table->index(['brand_id', 'status'], 'idx_vehicles_brand_status');
            $table->index('price', 'idx_vehicles_price');
            $table->index('type', 'idx_vehicles_type');
            $table->index('status', 'idx_vehicles_status');
        });

        // Reviews table indexes
        Schema::table('reviews', function (Blueprint $table) {
            $table->index('vehicle_id', 'idx_reviews_vehicle');
            $table->index('booking_id', 'idx_reviews_booking');
            $table->index('rating', 'idx_reviews_rating');
        });

        // Payments table indexes
        Schema::table('payments', function (Blueprint $table) {
            $table->index(['booking_id', 'status'], 'idx_payments_booking_status');
            $table->index('status', 'idx_payments_status');
            $table->index('created_at', 'idx_payments_created');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropIndex('idx_bookings_user_status');
            $table->dropIndex('idx_bookings_vehicle_dates');
            $table->dropIndex('idx_bookings_created');
            $table->dropIndex('idx_bookings_status');
        });

        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropIndex('idx_vehicles_brand_status');
            $table->dropIndex('idx_vehicles_price');
            $table->dropIndex('idx_vehicles_type');
            $table->dropIndex('idx_vehicles_status');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropIndex('idx_reviews_vehicle');
            $table->dropIndex('idx_reviews_booking');
            $table->dropIndex('idx_reviews_rating');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropIndex('idx_payments_booking_status');
            $table->dropIndex('idx_payments_status');
            $table->dropIndex('idx_payments_created');
        });
    }
};
