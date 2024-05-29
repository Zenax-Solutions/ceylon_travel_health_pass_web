<?php

namespace App\Http\Controllers\Api;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\DestinationResource;
use App\Http\Resources\DestinationCollection;
use App\Http\Requests\DestinationStoreRequest;
use App\Http\Requests\DestinationUpdateRequest;

class DestinationController extends Controller
{
    public function index(Request $request): DestinationCollection
    {
        $this->authorize('view-any', Destination::class);

        $search = $request->get('search', '');

        $destinations = Destination::search($search)
            ->latest()
            ->paginate();

        return new DestinationCollection($destinations);
    }

    public function store(DestinationStoreRequest $request): DestinationResource
    {
        $this->authorize('create', Destination::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $destination = Destination::create($validated);

        return new DestinationResource($destination);
    }

    public function show(
        Request $request,
        Destination $destination
    ): DestinationResource {
        $this->authorize('view', $destination);

        return new DestinationResource($destination);
    }

    public function update(
        DestinationUpdateRequest $request,
        Destination $destination
    ): DestinationResource {
        $this->authorize('update', $destination);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($destination->image) {
                Storage::delete($destination->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $destination->update($validated);

        return new DestinationResource($destination);
    }

    public function destroy(
        Request $request,
        Destination $destination
    ): Response {
        $this->authorize('delete', $destination);

        if ($destination->image) {
            Storage::delete($destination->image);
        }

        $destination->delete();

        return response()->noContent();
    }
}
