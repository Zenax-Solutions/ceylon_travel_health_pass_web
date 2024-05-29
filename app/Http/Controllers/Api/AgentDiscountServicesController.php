<?php

namespace App\Http\Controllers\Api;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DiscountServiceResource;
use App\Http\Resources\DiscountServiceCollection;

class AgentDiscountServicesController extends Controller
{
    public function index(
        Request $request,
        Agent $agent
    ): DiscountServiceCollection {
        $this->authorize('view', $agent);

        $search = $request->get('search', '');

        $discountServices = $agent
            ->discountServices()
            ->search($search)
            ->latest()
            ->paginate();

        return new DiscountServiceCollection($discountServices);
    }

    public function store(
        Request $request,
        Agent $agent
    ): DiscountServiceResource {
        $this->authorize('create', DiscountService::class);

        $validated = $request->validate([
            'image' => ['nullable', 'image', 'max:1024'],
            'service_name' => ['required', 'string'],
            'location' => ['nullable', 'string'],
            'area' => ['nullable', 'string'],
            'discount_amount' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $discountService = $agent->discountServices()->create($validated);

        return new DiscountServiceResource($discountService);
    }
}
