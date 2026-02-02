<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display search results
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        $filters = $request->only(['brand', 'type', 'min_price', 'max_price', 'year']);

        // Base search query
        $searchQuery = Vehicle::search($query ?: '*')
            ->where('status', 'available');

        // Apply filters
        if (!empty($filters['brand'])) {
            $searchQuery->where('brand', $filters['brand']);
        }

        if (!empty($filters['type'])) {
            $searchQuery->where('type', $filters['type']);
        }

        // Get results with pagination
        $vehicles = $searchQuery->paginate(12)->appends($request->query());

        // Apply price filters (post-search since Scout doesn't support range queries)
        if (!empty($filters['min_price']) || !empty($filters['max_price'])) {
            $vehicles->getCollection()->transform(function ($vehicle) use ($filters) {
                $price = $vehicle->price_per_day;
                if (!empty($filters['min_price']) && $price < $filters['min_price']) return null;
                if (!empty($filters['max_price']) && $price > $filters['max_price']) return null;
                return $vehicle;
            })->filter();
        }

        // Get available brands and types for filters
        $brands = Vehicle::distinct()->pluck('brand')->sort();
        $types = Vehicle::distinct()->pluck('type')->sort();

        return view('search.results', compact('vehicles', 'query', 'filters', 'brands', 'types'));
    }

    /**
     * Autocomplete API endpoint
     */
    public function autocomplete(Request $request)
    {
        $query = $request->input('q');

        if (empty($query) || strlen($query) < 2) {
            return response()->json([]);
        }

        $suggestions = Vehicle::search($query)
            ->where('status', 'available')
            ->take(5)
            ->get()
            ->map(function ($vehicle) {
                return [
                    'id' => $vehicle->id,
                    'name' => $vehicle->name,
                    'brand' => $vehicle->brand,
                    'model' => $vehicle->model,
                    'price' => number_format($vehicle->price_per_day),
                    'image' => $vehicle->main_image,
                    'url' => route('vehicles.show', $vehicle->id),
                ];
            });

        return response()->json($suggestions);
    }

    /**
     * Get filter options
     */
    public function filters()
    {
        return response()->json([
            'brands' => Vehicle::distinct()->pluck('brand')->sort()->values(),
            'types' => Vehicle::distinct()->pluck('type')->sort()->values(),
            'years' => Vehicle::distinct()->pluck('year')->sort()->values(),
            'price_range' => [
                'min' => Vehicle::min('price_per_day'),
                'max' => Vehicle::max('price_per_day'),
            ],
        ]);
    }
}
