<?php

namespace App\Livewire;


use App\Models\Agent;
use App\Models\Destination;
use App\Models\EsimService;
use App\Models\Ticket;
use App\Services\Agents\DiscountServicesQrReader;
use App\Services\Agents\DiscountShopQrReader;
use App\Services\Agents\EsimQrReader;
use App\Services\Destination\DestinationBranchQrReader;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Session;

class QrScan extends Component
{

    public $qrCode;
    public $agent;

    public $selectionList;
    public $selection;

    public $destination = null;


    public function mount($destinationMode = null)
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

            if (Session::has('selection')) {
                $this->selection = Session::get('selection');
            } else {
                $this->initializeSelection();
            }
        } elseif (Session::has('branch_code')) {

            $this->destination = Destination::where('branch_number', Session::get('branch_code'))->where('status', 'publish')->first();
        } else {

            if ($destinationMode == 'true') {

                $this->redirectRoute('destination.login');
            } else {
                $this->redirectRoute('agent.login');
            }
        }
    }



    #[On('scanQrCode')]
    public function scanQrCode($decodedText)
    {
        // Initialize the agents
        $discount_shop_agent = new DiscountShopQrReader;
        $discount_service_agent = new DiscountServicesQrReader;
        $esim_agent = new EsimQrReader;
        $destination_portal = new DestinationBranchQrReader;

        // Get QR code
        $this->qrCode = $decodedText;


        if ($this->destination != null) {


            $record = Ticket::where('ticket_id', $this->qrCode)->first();

            if ($record) {

                if (isset($this->destination)) {
                    $status = $destination_portal->read($this->selection, $record);

                    if ($status) {
                        $this->dispatch('qrCodeValidated', status: $status, data: $record);
                    } else {
                        $status = 'invalid';
                    }
                } else {
                    $status = 'invalid';
                }
            } else {

                // Handle failed validation
                $this->dispatch('qrCodeValidated', status: 'invalid');
            }
        } else {

            // Validate QR code with database
            $record = Ticket::where('ticket_id', $this->qrCode)->first();

            if ($record) {
                // Ensure $this->agent is set and has a type property
                if (isset($this->agent) && isset($this->agent->type)) {
                    switch ($this->agent->type) {
                        case 'discount_agent':
                            $status = $discount_shop_agent->read($this->selection, $record);
                            break;

                        case 'service_agent':
                            $status = $discount_service_agent->read($this->selection, $record);
                            break;

                            // case 'esim_agent':
                            //     $status = $esim_agent->read($this->selection, $record);
                            //     break;

                        default:
                            $status = 'invalid';
                            break;
                    }
                } else {
                    $status = 'invalid';
                }

                $this->dispatch('qrCodeValidated', status: $status, data: $record);
            } else {

                // Handle failed validation
                $this->dispatch('qrCodeValidated', status: 'invalid');
            }
        }
    }


    public function updatedSelection()
    {
        // Store the selection in the session whenever it is updated
        Session::put('selection', $this->selection);
    }

    public function initializeSelection()
    {
        if (!empty($this->selectionList) && count($this->selectionList) > 0) {
            $defaultItem = $this->selectionList[0];
            $this->selection = $defaultItem->id;
        }
    }


    public function render()
    {
        if ($this->destination == null) {
            if ($this->agent->type == 'discount_agent') {
                $this->selectionList = $this->agent->discountShops->where('status', 'publish');
            } elseif ($this->agent->type == 'service_agent') {
                $this->selectionList = $this->agent->discountServices->where('status', 'publish');
            } elseif ($this->agent->type == 'esim_agent') {
                $this->selectionList = $this->agent->esimServices->where('status', 'publish');
            }
        } else {
            $this->selection = Session::has('branch_code');
        }

        return view('livewire.qr-scan');
    }
}
