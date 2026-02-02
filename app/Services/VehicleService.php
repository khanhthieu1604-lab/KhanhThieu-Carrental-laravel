<?php

namespace App\Services;

use App\Models\Vehicle;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class VehicleService
{
    /**
     * Get available vehicles with filters
     */
    public function getAvailableVehicles(array $filters = [])
    {
        $query = Vehicle::where('status', 'available')->with('brand');

        // Apply filters
        if (!empty($filters['brand'])) {
            $query->where('brand_id', $filters['brand']);
        }

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (!empty($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (!empty($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('description', 'like', '%' . $filters['search'] . '%');
            });
        }

        return $query->paginate($filters['per_page'] ?? 12);
    }

    /**
     * Create a new vehicle
     */
    public function createVehicle(array $data, ?UploadedFile $image = null): Vehicle
    {
        if ($image) {
            $data['image'] = $this->storeVehicleImage($image);
        }

        return Vehicle::create($data);
    }

    /**
     * Update vehicle
     */
    public function updateVehicle(Vehicle $vehicle, array $data, ?UploadedFile $image = null): bool
    {
        if ($image) {
            // Delete old image
            if ($vehicle->image && !str_starts_with($vehicle->image, 'http')) {
                Storage::disk('public')->delete($vehicle->image);
            }

            $data['image'] = $this->storeVehicleImage($image);
        }

        return $vehicle->update($data);
    }

    /**
     * Delete vehicle
     */
    public function deleteVehicle(Vehicle $vehicle): bool
    {
        // Delete image
        if ($vehicle->image && !str_starts_with($vehicle->image, 'http')) {
            Storage::disk('public')->delete($vehicle->image);
        }

        return $vehicle->delete();
    }

    /**
     * Store vehicle image
     */
    private function storeVehicleImage(UploadedFile $image): string
    {
        return $image->store('vehicles', 'public');
    }

    /**
     * Check vehicle availability for date range
     */
    public function checkAvailability(Vehicle $vehicle, Carbon $startDate, Carbon $endDate): bool
    {
        return $vehicle->isAvailable($startDate, $endDate);
    }

    /**
     * Get vehicle statistics
     */
    public function getVehicleStats(Vehicle $vehicle): array
    {
        return [
            'total_bookings' => $vehicle->bookings()->count(),
            'completed_bookings' => $vehicle->bookings()->where('status', 'completed')->count(),
            'average_rating' => $vehicle->reviews()->avg('rating') ?? 0,
            'total_reviews' => $vehicle->reviews()->count(),
            'total_revenue' => $vehicle->bookings()
                ->where('status', 'completed')
                ->sum('total_price'),
        ];
    }

    /**
     * Get all vehicle brands
     */
    public function getAllBrands()
    {
        return Brand::orderBy('name')->get();
    }

    /**
     * Get all vehicle types
     */
    public function getAllTypes(): array
    {
        return Vehicle::distinct()->pluck('type')->sort()->values()->toArray();
    }

    /**
     * Update vehicle status
     */
    public function updateStatus(Vehicle $vehicle, string $status): bool
    {
        return $vehicle->update(['status' => $status]);
    }
}
