<?php

namespace App\Http\Livewire;

use App\Models\Agent;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\EsimService;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AgentEsimServicesDetail extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    public Agent $agent;
    public EsimService $esimService;
    public $esimServiceImage;
    public $uploadIteration = 0;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New EsimService';

    protected $rules = [
        'esimServiceImage' => ['nullable', 'image', 'max:1024'],
        'esimService.service_name' => ['required', 'max:255', 'string'],
        'esimService.per_sim_price' => ['required', 'numeric'],
        'esimService.status' => ['required', 'max:255', 'string'],
    ];

    public function mount(Agent $agent): void
    {
        $this->agent = $agent;
        $this->resetEsimServiceData();
    }

    public function resetEsimServiceData(): void
    {
        $this->esimService = new EsimService();

        $this->esimServiceImage = null;
        $this->esimService->status = 'draft';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newEsimService(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.agent_esim_services.new_title');
        $this->resetEsimServiceData();

        $this->showModal();
    }

    public function editEsimService(EsimService $esimService): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.agent_esim_services.edit_title');
        $this->esimService = $esimService;

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

        if (!$this->esimService->agent_id) {
            $this->authorize('create', EsimService::class);

            $this->esimService->agent_id = $this->agent->id;
        } else {
            $this->authorize('update', $this->esimService);
        }

        if ($this->esimServiceImage) {
            $this->esimService->image = $this->esimServiceImage->store(
                'public'
            );
        }

        $this->esimService->save();

        $this->uploadIteration++;

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', EsimService::class);

        collect($this->selected)->each(function (string $id) {
            $esimService = EsimService::findOrFail($id);

            if ($esimService->image) {
                Storage::delete($esimService->image);
            }

            $esimService->delete();
        });

        $this->selected = [];
        $this->allSelected = false;

        $this->resetEsimServiceData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->agent->esimServices as $esimService) {
            array_push($this->selected, $esimService->id);
        }
    }

    public function render(): View
    {
        return view('livewire.agent-esim-services-detail', [
            'esimServices' => $this->agent->esimServices()->paginate(20),
        ]);
    }
}
