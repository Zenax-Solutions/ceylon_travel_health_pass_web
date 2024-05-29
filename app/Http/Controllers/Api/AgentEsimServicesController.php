<?php

namespace App\Http\Controllers\Api;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EsimServiceResource;
use App\Http\Resources\EsimServiceCollection;

class AgentEsimServicesController extends Controller
{
    public function index(Request $request, Agent $agent): EsimServiceCollection
    {
        $this->authorize('view', $agent);

        $search = $request->get('search', '');

        $esimServices = $agent
            ->esimServices()
            ->search($search)
            ->latest()
            ->paginate();

        return new EsimServiceCollection($esimServices);
    }

    public function store(Request $request, Agent $agent): EsimServiceResource
    {
        $this->authorize('create', EsimService::class);

        $validated = $request->validate([
            'image' => ['nullable', 'image', 'max:1024'],
            'service_name' => ['required', 'string'],
            'per_sim_price' => ['required', 'numeric'],
            'status' => ['required', 'string'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $esimService = $agent->esimServices()->create($validated);

        return new EsimServiceResource($esimService);
    }
}
