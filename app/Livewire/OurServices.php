<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Agent;
use App\Models\DiscountService;
use App\Models\DiscountShop;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Session;

class OurServices extends Component
{
    use WithFileUploads;

    public $formTitle = 'Create Service';

    public $agent;

    public $service_name;
    public $image;
    public $location;
    public $area;
    public $discount_amount;


    public function mount()
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
        } else {
            $this->redirectRoute('agent.login');
        }
    }

    protected $rules = [
        'service_name' => 'required|string',
        'image' => 'required|image|max:1024',
        'location' => 'required|string',
        'area' => 'required|string',
        'discount_amount' => 'required|numeric',
    ];

    public function submit()
    {
        $this->validate();

        // Check if the agent type is discount_agent or service_agent
        if ($this->agent->type == 'discount_agent') {
            // Check if a DiscountShop record already exists for this agent
            $existingRecord = DiscountShop::where('agent_id', $this->agent->id)->first();

            if ($existingRecord) {
                // Show warning message
                toastr()->warning('Service is already add!', 'Warning');
            } else {
                // Create a new DiscountShop record
                DiscountShop::create([
                    'agent_id' => $this->agent->id,
                    'shope_name' => $this->service_name,
                    'image' => $this->image ? $this->image->store('', 'public') : null,
                    'location' => $this->location,
                    'area' => $this->area,
                    'discount_amount' => $this->discount_amount,
                    'status' => 'pending',
                ]);

                // Show success message
                toastr()->success('Service Added Successfully!', 'Congrats');
            }
        } elseif ($this->agent->type == 'service_agent') {
            // Check if a DiscountService record already exists for this agent
            $existingRecord = DiscountService::where('agent_id', $this->agent->id)->first();

            if ($existingRecord) {
                // Show warning message
                toastr()->warning('Service is already add!', 'Warning');
            } else {
                // Create a new DiscountService record
                DiscountService::create([
                    'agent_id' => $this->agent->id,
                    'service_name' => $this->service_name,
                    'image' => $this->image ? $this->image->store('', 'public') : null,
                    'location' => $this->location,
                    'area' => $this->area,
                    'discount_amount' => $this->discount_amount,
                    'status' => 'pending',
                ]);

                // Show success message
                toastr()->success('Service Added Successfully!', 'Congrats');
            }
        }

        // Reset form fields after submission
        $this->reset(['service_name', 'image', 'location', 'area', 'discount_amount']);



        // Redirect to agent services page
        return redirect()->route('agent.services');
    }



    public function remove($id)
    {
        // Check if the agent type is discount_agent or service_agent
        if ($this->agent->type == 'discount_agent') {
            // Check if a DiscountShop record already exists for this agent
            $existingRecord = DiscountShop::find($id);

            $existingRecord->delete();
            // Show success message
            toastr()->success('Successfully Deleted!', 'Congrats');
        } elseif ($this->agent->type == 'service_agent') {
            // Check if a DiscountService record already exists for this agent
            $existingRecord = DiscountService::find($id);

            $existingRecord->delete();

            // Show success message
            toastr()->success('Successfully Deleted!', 'Congrats');
        }
    }


    public function cleanData()
    {
        $this->service_name = '';
        $this->image = '';
        $this->location = '';
        $this->area = '';
        $this->discount_amount = '';
        $this->formTitle = 'Create Service';
    }

    public function render()
    {
        return view('livewire.our-services');
    }
}
