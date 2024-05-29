<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\DiscountService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\DiscountServiceResource;
use App\Http\Resources\DiscountServiceCollection;
use App\Http\Requests\DiscountServiceStoreRequest;
use App\Http\Requests\DiscountServiceUpdateRequest;

class DiscountServiceController extends Controller
{
    public function index(Request $request): DiscountServiceCollection
    {
        $this->authorize('view-any', DiscountService::class);

        $search = $request->get('search', '');

        $discountServices = DiscountService::search($search)
            ->latest()
            ->paginate();

        return new DiscountServiceCollection($discountServices);
    }

    public function store(
        DiscountServiceStoreRequest $request
    ): DiscountServiceResource {
        $this->authorize('create', DiscountService::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $discountService = DiscountService::create($validated);

        return new DiscountServiceResource($discountService);
    }

    public function show(
        Request $request,
        DiscountService $discountService
    ): DiscountServiceResource {
        $this->authorize('view', $discountService);

        return new DiscountServiceResource($discountService);
    }

    public function update(
        DiscountServiceUpdateRequest $request,
        DiscountService $discountService
    ): DiscountServiceResource {
        $this->authorize('update', $discountService);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($discountService->image) {
                Storage::delete($discountService->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $discountService->update($validated);

        return new DiscountServiceResource($discountService);
    }

    public function destroy(
        Request $request,
        DiscountService $discountService
    ): Response {
        $this->authorize('delete', $discountService);

        if ($discountService->image) {
            Storage::delete($discountService->image);
        }

        $discountService->delete();

        return response()->noContent();
    }
}
