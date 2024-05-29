<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DestinationResource;
use App\Http\Resources\DestinationCollection;

class CityDestinationsController extends Controller
{
    public function index(Request $request, City $city): DestinationCollection
    {
        $this->authorize('view', $city);

        $search = $request->get('search', '');

        $destinations = $city
            ->destinations()
            ->search($search)
            ->latest()
            ->paginate();

        return new DestinationCollection($destinations);
    }

    public function store(Request $request, City $city): DestinationResource
    {
        $this->authorize('create', Destination::class);

        $validated = $request->validate([
            'image' => ['nullable', 'image', 'max:1024'],
            'destination' => ['required', 'string'],
            'location' => ['nullable', 'string'],
            'south_asian_price' => ['required', 'numeric'],
            'non_south_asian_price' => ['required', 'numeric'],
            'discount_price' => ['nullable', 'numeric'],
            'status' => ['required', 'string'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $destination = $city->destinations()->create($validated);

        return new DestinationResource($destination);
    }
}
