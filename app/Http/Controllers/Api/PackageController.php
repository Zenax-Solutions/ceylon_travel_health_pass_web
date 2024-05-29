<?php

namespace App\Http\Controllers\Api;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PackageResource;
use App\Http\Resources\PackageCollection;
use App\Http\Requests\PackageStoreRequest;
use App\Http\Requests\PackageUpdateRequest;

class PackageController extends Controller
{
    public function index(Request $request): PackageCollection
    {
        $this->authorize('view-any', Package::class);

        $search = $request->get('search', '');

        $packages = Package::search($search)
            ->latest()
            ->paginate();

        return new PackageCollection($packages);
    }

    public function store(PackageStoreRequest $request): PackageResource
    {
        $this->authorize('create', Package::class);

        $validated = $request->validated();
        $validated['discount_shop_list'] = json_decode(
            $validated['discount_shop_list'],
            true
        );

        $validated['discount_service_list'] = json_decode(
            $validated['discount_service_list'],
            true
        );

        $package = Package::create($validated);

        return new PackageResource($package);
    }

    public function show(Request $request, Package $package): PackageResource
    {
        $this->authorize('view', $package);

        return new PackageResource($package);
    }

    public function update(
        PackageUpdateRequest $request,
        Package $package
    ): PackageResource {
        $this->authorize('update', $package);

        $validated = $request->validated();

        $validated['discount_shop_list'] = json_decode(
            $validated['discount_shop_list'],
            true
        );

        $validated['discount_service_list'] = json_decode(
            $validated['discount_service_list'],
            true
        );

        $package->update($validated);

        return new PackageResource($package);
    }

    public function destroy(Request $request, Package $package): Response
    {
        $this->authorize('delete', $package);

        $package->delete();

        return response()->noContent();
    }
}
