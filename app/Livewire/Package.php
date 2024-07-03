<?php

namespace App\Livewire;

use App\Models\Agent;
use App\Models\Booking;
use App\Models\City;
use App\Models\Customer;
use App\Models\Destination;
use App\Models\EsimService;
use App\Models\Package as ModelsPackage;
use App\Models\PointsHistory;
use App\Services\GenarateQrCodes;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class Package extends Component
{
    use WithFileUploads;

    public $packageId, $package, $destinations, $citys;

    public $selectedDestinationIds = [];

    public $esimOption = false;
    public $esimList = [];

    public $esimCount = 0;
    public $esimServiceProviderList;
    #[Validate('required')]
    public $esimServiceProvider;

    public $passportImages = [];

    public $destinationsCount = 0;

    public $esimProviderPrice = 0;
    public $totalPrice = 0;
    public $grandTotal = 0;
    public $totalOfChildPrice = 0;
    #[Validate('required')]
    public $adult_count = 1;
    #[Validate('required')]
    public $children_count = 0;

    public $showModal = false;
    public $auth_customer;
    public $auth_agent;

    public $coupon_code;
    public $coupon_data, $coupon_message = ['color' => '', 'message' => ''];
    public $discount = 0;

    #[Computed]
    public function mount(Request $request, $tour_agent_mode = null)
    {
        $this->packageId = $request->id;

        if ($tour_agent_mode == null) {
            if ($request->session()->has('auth_customer')) {

                $customer = Customer::where('email', $request->session()->get('auth_customer'))->first();

                if ($customer != null) {
                    $this->auth_customer = $customer;
                    $this->showModal = false;
                } else {
                    $this->showModal = true;
                    $this->redirect('/');
                }
            } else {
                $this->showModal = true;
            }
        } else {
            if ($request->session()->has('auth_agent')) {

                $agent = Agent::where('email', Session::get('auth_agent'))->firstOrFail();

                if ($agent != null) {
                    $this->auth_agent = $agent;
                    $this->showModal = false;

                    if ($agent->agent_discount_margin > 5) {
                        $this->discount = $agent->agent_discount_margin;
                    } else {
                        $this->discount = env('AGENT_DISCONUNT_MARGIN', 0);
                    }
                } else {
                    $this->redirectRoute('agent.packages');
                }
            } else {
                $this->redirectRoute('agent.packages');
            }
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'passportImages.*' => 'required|image',
        ]);

        $this->children_count =  $this->children_count == '' ? 0 : $this->children_count;

        $this->adult_count =  $this->adult_count == '' ? 1 : $this->adult_count;

        $this->esimCount = $this->esimCount == '' ? 0 : $this->esimCount;

        if (isset($this->esimServiceProvider)) {

            if ($this->esimServiceProvider == 'null') {
                $this->esimProviderPrice = 0;
            } else {
                $this->esimProviderPrice = EsimService::find($this->esimServiceProvider)->per_sim_price;
            }
        }


        if ($this->esimOption != true) {
            $this->esimCount = 0;
            $this->esimProviderPrice = 0;
            $this->esimServiceProvider = null;
        }

        if (isset($this->coupon_code)) {
            $validate = Agent::where('type', 'tour_agent')->where('coupon_code', $this->coupon_code);

            if ($validate->exists()) {
                $this->coupon_message = [
                    'color' => 'text-green-400',
                    'message' => 'Valid Coupon code'
                ];
                $this->coupon_data = $validate->get();
                $this->discount =  env('CUSTOMER_DISCONUNT_MARGIN', 5);
            } else {
                $this->coupon_message = [
                    'color' => 'text-red-400',
                    'message' => 'Invalid Coupon code!'
                ];
                $this->coupon_data = null;
                $this->discount = 0;
            }
        }
    }



    public function render()
    {
        $this->package = ModelsPackage::find($this->packageId);

        if ($this->package == null) {

            if ($this->auth_agent != null) {
                $this->redirectRoute('agent.packages');
            } else {
                $this->redirect('/');
            }
        } else {
            $this->package->first();
            $this->destinations = Destination::all();
            $this->citys = City::all();
            $this->esimServiceProviderList = EsimService::where('status', 'publish')->get();
        }



        return view('livewire.package');
    }


    #[On('selectedDestinationIds')]
    public function submit($selectedDestinationIds)
    {

        $this->selectedDestinationIds = $selectedDestinationIds;
    }

    #[On('updatePrice')]
    public function updateTotalPrice($totalPrice, $totalOfChildPrice)
    {
        //Get Total of Destination Child Price

        $this->totalOfChildPrice = $totalOfChildPrice;

        $this->totalPrice = $totalPrice;
        // Calculate grand total
        $this->grandTotal = $this->totalPrice + $this->package->price;
    }

    public function getSelectedDestinationCount()
    {
        $this->destinationsCount = count($this->selectedDestinationIds);

        return count($this->selectedDestinationIds);
    }

    public function addEsim()
    {
        $this->esimCount++;
    }

    public function removeEsim($index)
    {
        if (isset($this->passportImages[$index])) {
            $this->passportImages[$index]->temporaryUrl(); // Remove the temporary file
            $this->esimCount--;
            unset($this->passportImages[$index]);
        }
    }


    public function esimToggaleShow()
    {
        if ($this->esimOption == true) {
            $this->esimOption = false;
        } else {
            $this->esimOption = true;
        }
    }


    public function submitBooking()
    {
        $this->validate([
            'adult_count' => 'required|integer|min:1|max:50',
            'children_count' => 'required|integer|min:0|max:50',
        ]);

        if ($this->esimOption == true) {

            $this->validate([
                'esimServiceProvider' => 'required',
            ]);

            for ($i = 0; $i < $this->esimCount; $i++) {
                $this->validate(
                    [
                        'passportImages.' . $i => 'image|max:1024|required'
                    ],
                    [
                        'passportImages.' . $i . '.required' => 'Please upload a passport image.',
                        'passportImages.' . $i . '.image' => 'The uploaded file must be an image.',
                    ]
                );
            }

            if ($this->esimServiceProvider == 'null') {

                toastr()->error('Please select the esim provider!');
            } else {

                $this->booking('withEsim');
            }
        } else {

            $this->esimCount = 0;


            $this->booking('withOutEsim');
        }
    }


    public function booking($type)
    {
        $esimData = [];

        $customer = $this->auth_customer;
        $genrateQrCode = new GenarateQrCodes;

        if ($type == 'withEsim') {


            $passportImagePaths = [];
            foreach ($this->passportImages as $passportImage) {
                $path = $passportImage->store('passport_images', 'public');
                $passportImagePaths[] = $path;
            }

            $esimData = [
                'esim_count' => $this->esimCount,
                'esim_provider_id' => $this->esimServiceProvider,
                'passport_images' => $passportImagePaths,
            ];


            $PackageData = [
                'package_id' => $this->packageId,
                'customer_id' =>  $this->auth_customer->id,
                'adult_pass_count' => $this->adult_count,
                'child_pass_count' => $this->children_count,
                'destination_list' => $this->selectedDestinationIds,
                'esim_list' => $esimData,
                'total' => $this->calculateTotalPrice(),
                'date' => Carbon::now(),
                'payment_status' => 'pending',
            ];

            $booking = Booking::create($PackageData);

            $genrateQrCode->genarate($PackageData, $booking, $customer);

            if (isset($this->coupon_code)) {
                $agent = Agent::where('coupon_code', $this->coupon_code);

                if ($agent->exists()) {

                    $getAgent = $agent->where('coupon_code', $this->coupon_code)->first();

                    //$getAgent->increment('points', env('AGENT_DISCONUNT_MARGIN', 5));

                    PointsHistory::create([
                        'agent_id' => $getAgent->id,
                        'points' => env('AGENT_DISCONUNT_MARGIN', 5),
                        'date' => Carbon::now(),
                    ]);
                }
            }

            toastr()->success('Booking Successfully');
            $this->redirectRoute('payment.info');
        } elseif ($type == 'withOutEsim') {

            if ($this->auth_agent != null) {

                $PackageData = [
                    'package_id' => $this->packageId,
                    'agent_id' =>  $this->auth_agent->id,
                    'adult_pass_count' => $this->adult_count,
                    'child_pass_count' => $this->children_count,
                    'destination_list' => $this->selectedDestinationIds,
                    'esim_list' => $esimData,
                    'total' => $this->calculateTotalPrice(),
                    'date' => Carbon::now(),
                    'payment_status' => 'pending',
                ];
            } else {
                $PackageData = [
                    'package_id' => $this->packageId,
                    'customer_id' =>  $this->auth_customer->id,
                    'adult_pass_count' => $this->adult_count,
                    'child_pass_count' => $this->children_count,
                    'destination_list' => $this->selectedDestinationIds,
                    'esim_list' => $esimData,
                    'total' => $this->calculateTotalPrice(),
                    'date' => Carbon::now(),
                    'payment_status' => 'pending',
                ];
            }



            if ($this->adult_count > 50 || $this->children_count > 50 || ($this->adult_count + $this->children_count) > 50) {
                toastr()->error('Maximum Guest count is 50');
            } else {

                $booking = Booking::create($PackageData);


                if ($this->auth_agent != null) {
                    $genrateQrCode->genarate($PackageData, $booking, $this->auth_agent);
                } else {
                    $genrateQrCode->genarate($PackageData, $booking, $customer);
                }



                if (isset($this->coupon_code)) {
                    $agent = Agent::where('coupon_code', $this->coupon_code);

                    if ($agent->exists()) {


                        $getAgent = $agent->where('coupon_code', $this->coupon_code)->first();

                        PointsHistory::create([
                            'agent_id' => $getAgent->id,
                            'points' => env('AGENT_DISCONUNT_MARGIN', 5),
                            'date' => Carbon::now(),
                        ]);
                    }
                }

                toastr()->success('Booking Successfully');

                if ($this->auth_agent != null) {
                    $this->redirectRoute('agent.dashboard');
                } else {
                    $this->redirectRoute('payment.info');
                }
            }
        }
    }


    public function calculateTotalPrice()
    {
        $adultPriceTotal = $this->adult_count * $this->grandTotal;
        $childPriceTotal = $this->children_count * $this->totalOfChildPrice;
        $esimPriceTotal = $this->esimCount * $this->esimProviderPrice;

        $total = $adultPriceTotal + $childPriceTotal + $esimPriceTotal - $this->discount;

        return $total;
    }
}
