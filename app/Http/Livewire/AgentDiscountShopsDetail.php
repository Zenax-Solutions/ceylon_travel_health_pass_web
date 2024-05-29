<?php

namespace App\Http\Livewire;

use App\Models\Agent;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use App\Models\DiscountShop;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AgentDiscountShopsDetail extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    public Agent $agent;
    public DiscountShop $discountShop;
    public $discountShopImage;
    public $uploadIteration = 0;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New DiscountShop';

    protected $rules = [
        'discountShopImage' => ['nullable', 'image', 'max:1024'],
        'discountShop.shope_name' => ['required', 'string'],
        'discountShop.location' => ['nullable', 'string'],
        'discountShop.area' => ['nullable', 'string'],
        'discountShop.discount_amount' => ['nullable', 'string'],
        'discountShop.status' => ['nullable', 'string'],
    ];

    public function mount(Agent $agent): void
    {
        $this->agent = $agent;
        $this->resetDiscountShopData();
    }

    public function resetDiscountShopData(): void
    {
        $this->discountShop = new DiscountShop();

        $this->discountShopImage = null;
        $this->discountShop->status = 'draft';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newDiscountShop(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.agent_discount_shops.new_title');
        $this->resetDiscountShopData();

        $this->showModal();
    }

    public function editDiscountShop(DiscountShop $discountShop): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.agent_discount_shops.edit_title');
        $this->discountShop = $discountShop;

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

        if (!$this->discountShop->agent_id) {
            $this->authorize('create', DiscountShop::class);

            $this->discountShop->agent_id = $this->agent->id;
        } else {
            $this->authorize('update', $this->discountShop);
        }

        if ($this->discountShopImage) {
            $this->discountShop->image = $this->discountShopImage->store(
                'public'
            );
        }

        $this->discountShop->save();

        $this->uploadIteration++;

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', DiscountShop::class);

        collect($this->selected)->each(function (string $id) {
            $discountShop = DiscountShop::findOrFail($id);

            if ($discountShop->image) {
                Storage::delete($discountShop->image);
            }

            $discountShop->delete();
        });

        $this->selected = [];
        $this->allSelected = false;

        $this->resetDiscountShopData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->agent->discountShops as $discountShop) {
            array_push($this->selected, $discountShop->id);
        }
    }

    public function render(): View
    {
        return view('livewire.agent-discount-shops-detail', [
            'discountShops' => $this->agent->discountShops()->paginate(20),
        ]);
    }
}
