<?php

namespace App\Http\Controllers\Api;

use App\Models\EsimService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\EsimServiceResource;
use App\Http\Resources\EsimServiceCollection;
use App\Http\Requests\EsimServiceStoreRequest;
use App\Http\Requests\EsimServiceUpdateRequest;

class EsimServiceController extends Controller
{
    public function index(Request $request): EsimServiceCollection
    {
        $this->authorize('view-any', EsimService::class);

        $search = $request->get('search', '');

        $esimServices = EsimService::search($search)
            ->latest()
            ->paginate();

        return new EsimServiceCollection($esimServices);
    }

    public function store(EsimServiceStoreRequest $request): EsimServiceResource
    {
        $this->authorize('create', EsimService::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $esimService = EsimService::create($validated);

        return new EsimServiceResource($esimService);
    }

    public function show(
        Request $request,
        EsimService $esimService
    ): EsimServiceResource {
        $this->authorize('view', $esimService);

        return new EsimServiceResource($esimService);
    }

    public function update(
        EsimServiceUpdateRequest $request,
        EsimService $esimService
    ): EsimServiceResource {
        $this->authorize('update', $esimService);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($esimService->image) {
                Storage::delete($esimService->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $esimService->update($validated);

        return new EsimServiceResource($esimService);
    }

    public function destroy(
        Request $request,
        EsimService $esimService
    ): Response {
        $this->authorize('delete', $esimService);

        if ($esimService->image) {
            Storage::delete($esimService->image);
        }

        $esimService->delete();

        return response()->noContent();
    }
}
