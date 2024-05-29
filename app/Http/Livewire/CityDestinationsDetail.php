<?php

namespace App\Http\Livewire;

use App\Models\City;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Destination;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CityDestinationsDetail extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    public City $city;
    public Destination $destination;
    public $destinationImage;
    public $uploadIteration = 0;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Destination';

    protected $rules = [
        'destination.destination' => ['required', 'max:255', 'string'],
        'destinationImage' => ['nullable', 'image', 'max:1024'],
        'destination.location' => ['nullable', 'max:255', 'string'],
        'destination.south_asian_price' => ['required', 'numeric'],
        'destination.non_south_asian_price' => ['required', 'numeric'],
        'destination.discount_price' => ['nullable', 'numeric'],
        'destination.status' => ['required', 'max:255', 'string'],
    ];

    public function mount(City $city): void
    {
        $this->city = $city;
        $this->resetDestinationData();
    }

    public function resetDestinationData(): void
    {
        $this->destination = new Destination();

        $this->destinationImage = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newDestination(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.city_destinations.new_title');
        $this->resetDestinationData();

        $this->showModal();
    }

    public function editDestination(Destination $destination): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.city_destinations.edit_title');
        $this->destination = $destination;

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

        if (!$this->destination->city_id) {
            $this->authorize('create', Destination::class);

            $this->destination->city_id = $this->city->id;
        } else {
            $this->authorize('update', $this->destination);
        }

        if ($this->destinationImage) {
            $this->destination->image = $this->destinationImage->store(
                'public'
            );
        }

        $this->destination->save();

        $this->uploadIteration++;

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Destination::class);

        collect($this->selected)->each(function (string $id) {
            $destination = Destination::findOrFail($id);

            if ($destination->image) {
                Storage::delete($destination->image);
            }

            $destination->delete();
        });

        $this->selected = [];
        $this->allSelected = false;

        $this->resetDestinationData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->city->destinations as $destination) {
            array_push($this->selected, $destination->id);
        }
    }

    public function render(): View
    {
        return view('livewire.city-destinations-detail', [
            'destinations' => $this->city->destinations()->paginate(20),
        ]);
    }
}
