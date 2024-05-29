<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Http\Resources\BookingCollection;

class CustomerBookingsController extends Controller
{
    public function index(
        Request $request,
        Customer $customer
    ): BookingCollection {
        $this->authorize('view', $customer);

        $search = $request->get('search', '');

        $bookings = $customer
            ->bookings()
            ->search($search)
            ->latest()
            ->paginate();

        return new BookingCollection($bookings);
    }

    public function store(Request $request, Customer $customer): BookingResource
    {
        $this->authorize('create', Booking::class);

        $validated = $request->validate([
            'package_id' => ['required', 'exists:packages,id'],
            'adult_pass_count' => ['required'],
            'child_pass_count' => ['nullable'],
            'total' => ['required', 'numeric'],
            'destination_list' => ['required', 'json'],
            'esim_list' => ['required', 'json'],
            'date' => ['required', 'date'],
            'payment_status' => ['required', 'string'],
        ]);

        $booking = $customer->bookings()->create($validated);

        return new BookingResource($booking);
    }
}
