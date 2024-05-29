<?php

namespace App\Http\Controllers\Api;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Http\Resources\BookingCollection;

class PackageBookingsController extends Controller
{
    public function index(Request $request, Package $package): BookingCollection
    {
        $this->authorize('view', $package);

        $search = $request->get('search', '');

        $bookings = $package
            ->bookings()
            ->search($search)
            ->latest()
            ->paginate();

        return new BookingCollection($bookings);
    }

    public function store(Request $request, Package $package): BookingResource
    {
        $this->authorize('create', Booking::class);

        $validated = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'adult_pass_count' => ['required'],
            'child_pass_count' => ['nullable'],
            'total' => ['required', 'numeric'],
            'destination_list' => ['required', 'json'],
            'esim_list' => ['required', 'json'],
            'date' => ['required', 'date'],
            'payment_status' => ['required', 'string'],
        ]);

        $booking = $package->bookings()->create($validated);

        return new BookingResource($booking);
    }
}
