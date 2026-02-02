<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingService
{
    /**
     * Create a new booking
     */
    public function createBooking(array $data, User $user): Booking
    {
        DB::beginTransaction();

        try {
            $vehicle = Vehicle::findOrFail($data['vehicle_id']);

            // Validate availability
            $startDate = Carbon::parse($data['start_date']);
            $endDate = Carbon::parse($data['end_date']);

            if (!$vehicle->isAvailable($startDate, $endDate)) {
                throw new \Exception('Xe không khả dụng trong khoảng thời gian này');
            }

            // Calculate price
            $totalPrice = $this->calculateTotalPrice(
                $vehicle,
                $startDate,
                $endDate,
                $data['with_driver'] ?? false,
                $data['insurance'] ?? false
            );

            // Create booking
            $booking = Booking::create([
                'user_id' => $user->id,
                'vehicle_id' => $vehicle->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'total_price' => $totalPrice,
                'status' => 'pending',
                'with_driver' => $data['with_driver'] ?? false,
                'insurance' => $data['insurance'] ?? false,
                'pickup_location' => $data['pickup_location'] ?? null,
                'dropoff_location' => $data['dropoff_location'] ?? null,
                'notes' => $data['notes'] ?? null,
            ]);

            // Update vehicle status
            $vehicle->update(['status' => 'reserved']);

            DB::commit();

            return $booking;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Calculate total booking price
     */
    public function calculateTotalPrice(
        Vehicle $vehicle,
        Carbon $startDate,
        Carbon $endDate,
        bool $withDriver = false,
        bool $insurance = false
    ): float {
        $days = $startDate->diffInDays($endDate);
        if ($days == 0) $days = 1;

        // Base price
        $total = $vehicle->price * $days;

        // Driver service (20% of base price)
        if ($withDriver) {
            $total += ($vehicle->price * $days * 0.20);
        }

        // Insurance (5% of base price)
        if ($insurance) {
            $total += ($vehicle->price * $days * 0.05);
        }

        return $total;
    }

    /**
     * Update booking status
     */
    public function updateStatus(Booking $booking, string $newStatus): bool
    {
        $oldStatus = $booking->status;

        $booking->update(['status' => $newStatus]);

        // Update vehicle status based on booking status
        if ($newStatus === 'confirmed') {
            $booking->vehicle->update(['status' => 'rented']);
        } elseif (in_array($newStatus, ['completed', 'cancelled'])) {
            $booking->vehicle->update(['status' => 'available']);
        }

        return true;
    }

    /**
     * Cancel booking
     */
    public function cancelBooking(Booking $booking): bool
    {
        if (!in_array($booking->status, ['pending', 'confirmed'])) {
            throw new \Exception('Không thể hủy đơn đặt này');
        }

        return $this->updateStatus($booking, 'cancelled');
    }

    /**
     * Get user's active bookings
     */
    public function getUserActiveBookings(User $user)
    {
        return Booking::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'confirmed', 'in_progress'])
            ->with('vehicle')
            ->orderBy('start_date', 'desc')
            ->get();
    }

    /**
     * Get user's booking history
     */
    public function getUserBookingHistory(User $user, int $perPage = 10)
    {
        return Booking::where('user_id', $user->id)
            ->with(['vehicle', 'payment'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}
