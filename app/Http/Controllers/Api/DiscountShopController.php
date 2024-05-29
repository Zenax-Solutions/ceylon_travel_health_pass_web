<?php

namespace App\Http\Controllers\Api;

use App\Models\DiscountShop;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\DiscountShopResource;
use App\Http\Resources\DiscountShopCollection;
use App\Http\Requests\DiscountShopStoreRequest;
use App\Http\Requests\DiscountShopUpdateRequest;

class DiscountShopController extends Controller
{
    public function index(Request $request): DiscountShopCollection
    {
        $this->authorize('view-any', DiscountShop::class);

        $search = $request->get('search', '');

        $discountShops = DiscountShop::search($search)
            ->latest()
            ->paginate();

        return new DiscountShopCollection($discountShops);
    }

    public function store(
        DiscountShopStoreRequest $request
    ): DiscountShopResource {
        $this->authorize('create', DiscountShop::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $discountShop = DiscountShop::create($validated);

        return new DiscountShopResource($discountShop);
    }

    public function show(
        Request $request,
        DiscountShop $discountShop
    ): DiscountShopResource {
        $this->authorize('view', $discountShop);

        return new DiscountShopResource($discountShop);
    }

    public function update(
        DiscountShopUpdateRequest $request,
        DiscountShop $discountShop
    ): DiscountShopResource {
        $this->authorize('update', $discountShop);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($discountShop->image) {
                Storage::delete($discountShop->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $discountShop->update($validated);

        return new DiscountShopResource($discountShop);
    }

    public function destroy(
        Request $request,
        DiscountShop $discountShop
    ): Response {
        $this->authorize('delete', $discountShop);

        if ($discountShop->image) {
            Storage::delete($discountShop->image);
        }

        $discountShop->delete();

        return response()->noContent();
    }
}
