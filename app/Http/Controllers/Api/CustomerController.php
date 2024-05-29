<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerCollection;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;

class CustomerController extends Controller
{
    public function index(Request $request): CustomerCollection
    {
        $this->authorize('view-any', Customer::class);

        $search = $request->get('search', '');

        $customers = Customer::search($search)
            ->latest()
            ->paginate();

        return new CustomerCollection($customers);
    }

    public function store(CustomerStoreRequest $request): CustomerResource
    {
        $this->authorize('create', Customer::class);

        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $customer = Customer::create($validated);

        return new CustomerResource($customer);
    }

    public function show(Request $request, Customer $customer): CustomerResource
    {
        $this->authorize('view', $customer);

        return new CustomerResource($customer);
    }

    public function update(
        CustomerUpdateRequest $request,
        Customer $customer
    ): CustomerResource {
        $this->authorize('update', $customer);

        $validated = $request->validated();

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        if ($request->hasFile('image')) {
            if ($customer->image) {
                Storage::delete($customer->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $customer->update($validated);

        return new CustomerResource($customer);
    }

    public function destroy(Request $request, Customer $customer): Response
    {
        $this->authorize('delete', $customer);

        if ($customer->image) {
            Storage::delete($customer->image);
        }

        $customer->delete();

        return response()->noContent();
    }
}
