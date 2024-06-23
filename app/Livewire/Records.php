<?php

namespace App\Livewire;

use App\Models\Agent;
use App\Models\Destination;
use App\Models\DestinationQrScanRecord;
use App\Models\ServiceQrScanRecord;
use App\Models\ShopeQrScanRecord;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\WithPagination;
use Carbon\Carbon;


class Records extends Component
{

    public $agent;

    public $destination;

    public $limit, $title;

    use WithPagination;

    public function mount($limit = null, $title = '', $destinationMode = null)
    {
        //checking the auth agent and redirect
        if (Session::has('auth_agent')) {
            $this->agent = Agent::where('email', Session::get('auth_agent'))->first();

            if ($this->agent->status == 'pending') {
                $this->redirectRoute('agent.dashboard');
            }

            if ($this->agent->type == 'tour_agent') {
                $this->redirectRoute('agent.dashboard');
            }
            $this->limit = $limit;
            $this->title = $title;
        } elseif (Session::has('branch_code')) {

            $this->destination = Destination::where('branch_number', Session::get('branch_code'))->where('status', 'publish')->first();

            $this->limit = $limit;
            $this->title = $title;
        } else {

            if ($destinationMode == 'true') {

                $this->redirectRoute('destination.login');
            } else {
                $this->redirectRoute('agent.login');
            }
        }
    }

    public function render()
    {
        if ($this->agent?->type == 'discount_agent') {
            $query = ShopeQrScanRecord::orderBy('created_at', 'desc');

            if ($this->limit != null) {
                $query = $query->limit($this->limit);
            }

            $records = $query->paginate(10);

            $todayCount = ShopeQrScanRecord::whereDate('created_at', Carbon::today())->count();
            $monthlyCount = ShopeQrScanRecord::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count();
        } elseif ($this->agent?->type == 'service_agent') {
            $query = ServiceQrScanRecord::orderBy('created_at', 'desc');

            if ($this->limit != null) {
                $query = $query->limit($this->limit);
            }

            $records = $query->paginate(10);

            $todayCount = ServiceQrScanRecord::whereDate('created_at', Carbon::today())->count();
            $monthlyCount = ServiceQrScanRecord::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count();
        } elseif ($this->destination != null) {
            $query = DestinationQrScanRecord::where('branch_number', Session::get('branch_code'))->where('status', 'publish')->orderBy('created_at', 'desc');

            if ($this->limit != null) {
                $query = $query->limit($this->limit);
            }

            $records = $query->paginate(10);

            $todayCount = DestinationQrScanRecord::whereDate('created_at', Carbon::today())->count();
            $monthlyCount = DestinationQrScanRecord::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count();
        } else {
            $records = null;
            $todayCount = 0;
            $monthlyCount = 0;
        }

        return view('livewire.records', compact('records', 'todayCount', 'monthlyCount'));
    }
}
