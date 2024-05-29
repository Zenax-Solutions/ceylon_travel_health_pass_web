<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Package;
use App\Models\Customer;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CustomerBookingsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Customer $customer;
    public Booking $booking;
    public $packagesForSelect = [];
    public $bookingDate;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Booking';

    protected $rules = [
        'booking.package_id' => ['required', 'exists:packages,id'],
        'booking.adult_pass_count' => ['required'],
        'booking.child_pass_count' => ['nullable'],
        'booking.destination_list' => ['required', 'json'],
        'booking.esim_list' => ['required', 'json'],
        'booking.total' => ['required', 'numeric'],
        'bookingDate' => ['required', 'date'],
        'booking.payment_status' => ['required', 'string'],
    ];

    public function mount(Customer $customer): void
    {
        $this->customer = $customer;
        $this->packagesForSelect = Package::pluck('main_title', 'id');
        $this->resetBookingData();
    }

    public function resetBookingData(): void
    {
        $this->booking = new Booking();

        $this->bookingDate = null;
        $this->booking->package_id = null;
        $this->booking->payment_status = 'pending';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newBooking(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.customer_bookings.new_title');
        $this->resetBookingData();

        $this->showModal();
    }

    public function editBooking(Booking $booking): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.customer_bookings.edit_title');
        $this->booking = $booking;

        $this->bookingDate = optional($this->booking->date)->format('Y-m-d');

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

        if (!$this->booking->customer_id) {
            $this->authorize('create', Booking::class);

            $this->booking->customer_id = $this->customer->id;
        } else {
            $this->authorize('update', $this->booking);
        }

        $this->booking->destination_list = json_decode(
            $this->booking->destination_list,
            true
        );

        $this->booking->esim_list = json_decode(
            $this->booking->esim_list,
            true
        );

        $this->booking->date = \Carbon\Carbon::make($this->bookingDate);

        $this->booking->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Booking::class);

        Booking::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetBookingData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->customer->bookings as $booking) {
            array_push($this->selected, $booking->id);
        }
    }

    public function render(): View
    {
        return view('livewire.customer-bookings-detail', [
            'bookings' => $this->customer->bookings()->paginate(20),
        ]);
    }
}
