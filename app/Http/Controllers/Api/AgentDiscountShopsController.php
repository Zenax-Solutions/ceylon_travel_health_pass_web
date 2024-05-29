<?php

namespace App\Http\Controllers\Api;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DiscountShopResource;
use App\Http\Resources\DiscountShopCollection;

class AgentDiscountShopsController extends Controller
{
    public function index(
        Request $request,
        Agent $agent
    ): DiscountShopCollection {
        $this->authorize('view', $agent);

        $search = $request->get('search', '');

        $discountShops = $agent
            ->discountShops()
            ->search($search)
            ->latest()
            ->paginate();

        return new DiscountShopCollection($discountShops);
    }

    public function store(Request $request, Agent $agent): DiscountShopResource
    {
        $this->authorize('create', DiscountShop::class);

        $validated = $request->validate([
            'image' => ['nullable', 'image', 'max:1024'],
            'shope_name' => ['required', 'string'],
            'location' => ['nullable', 'string'],
            'area' => ['nullable', 'string'],
            'discount_amount' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $discountShop = $agent->discountShops()->create($validated);

        return new DiscountShopResource($discountShop);
    }
}
