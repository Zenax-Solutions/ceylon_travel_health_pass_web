<?php

namespace App\Livewire;

use App\Models\Agent;
use App\Models\ServiceQrScanRecord;
use App\Models\ShopeQrScanRecord;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\WithPagination;
use Carbon\Carbon;


class Records extends Component
{

    public $agent;

    public $limit, $title;

    use WithPagination;

    public function mount($limit = null, $title = '')
    {
        //checking the auth agent and redirect
        if (Session::has('auth_agent')) {
            $this->agent = Agent::where('email', Session::get('auth_agent'))->first();

            if ($this->agent->type == 'tour_agent') {
                $this->redirectRoute('agent.dashboard');
            }
            $this->limit = $limit;
            $this->title = $title;
        } else {
            $this->redirectRoute('agent.login');
        }
    }

    public function render()
    {
        if ($this->agent->type == 'discount_agent') {
            $query = ShopeQrScanRecord::orderBy('created_at', 'desc');

            if ($this->limit != null) {
                $query = $query->limit($this->limit);
            }

            $records = $query->paginate(10);

            $todayCount = ShopeQrScanRecord::whereDate('created_at', Carbon::today())->count();
            $monthlyCount = ShopeQrScanRecord::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count();
        } elseif ($this->agent->type == 'service_agent') {
            $query = ServiceQrScanRecord::orderBy('created_at', 'desc');

            if ($this->limit != null) {
                $query = $query->limit($this->limit);
            }

            $records = $query->paginate(10);

            $todayCount = ServiceQrScanRecord::whereDate('created_at', Carbon::today())->count();
            $monthlyCount = ServiceQrScanRecord::whereMonth('created_at', Carbon::now()->month)
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
