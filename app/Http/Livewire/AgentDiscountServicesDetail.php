<?php

namespace App\Http\Livewire;

use App\Models\Agent;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\DiscountService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AgentDiscountServicesDetail extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    public Agent $agent;
    public DiscountService $discountService;
    public $discountServiceImage;
    public $uploadIteration = 0;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New DiscountService';

    protected $rules = [
        'discountServiceImage' => ['nullable', 'image', 'max:1024'],
        'discountService.service_name' => ['required', 'string'],
        'discountService.location' => ['nullable', 'string'],
        'discountService.area' => ['nullable', 'string'],
        'discountService.discount_amount' => ['nullable', 'string'],
        'discountService.status' => ['nullable', 'string'],
    ];

    public function mount(Agent $agent): void
    {
        $this->agent = $agent;
        $this->resetDiscountServiceData();
    }

    public function resetDiscountServiceData(): void
    {
        $this->discountService = new DiscountService();

        $this->discountServiceImage = null;
        $this->discountService->status = 'draft';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newDiscountService(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.agent_discount_services.new_title');
        $this->resetDiscountServiceData();

        $this->showModal();
    }

    public function editDiscountService(DiscountService $discountService): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.agent_discount_services.edit_title');
        $this->discountService = $discountService;

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal(): void
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal(): void
    {
        $this->showingModal = false;
    }

    public function save(): void
    {
        $this->validate();

        if (!$this->discountService->agent_id) {
            $this->authorize('create', DiscountService::class);

            $this->discountService->agent_id = $this->agent->id;
        } else {
            $this->authorize('update', $this->discountService);
        }

        if ($this->discountServiceImage) {
            $this->discountService->image = $this->discountServiceImage->store(
                'public'
            );
        }

        $this->discountService->save();

        $this->uploadIteration++;

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', DiscountService::class);

        collect($this->selected)->each(function (string $id) {
            $discountService = DiscountService::findOrFail($id);

            if ($discountService->image) {
                Storage::delete($discountService->image);
            }

            $discountService->delete();
        });

        $this->selected = [];
        $this->allSelected = false;

        $this->resetDiscountServiceData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->agent->discountServices as $discountService) {
            array_push($this->selected, $discountService->id);
        }
    }

    public function render(): View
    {
        return view('livewire.agent-discount-services-detail', [
            'discountServices' => $this->agent
                ->discountServices()
                ->paginate(20),
        ]);
    }
}
