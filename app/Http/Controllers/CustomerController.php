<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Artesaos\SEOTools\Facades\SEOMeta;
use Joaopaulolndev\FilamentGeneralSettings\Models\GeneralSetting;
use Artesaos\SEOTools\Facades\OpenGraph;

class CustomerController extends Controller
{

    private $genaralSettings;

    public function __construct() {
        $this->genaralSettings = GeneralSetting::first();
    }

    //seo function
    public function seo()
    {
        
        SEOMeta::setTitle($this->genaralSettings?->site_name);
        SEOMeta::setDescription($this->genaralSettings?->site_description);
        SEOMeta::addMeta('article:section', $this->genaralSettings?->seo_title , 'property');
        SEOMeta::addKeyword([$this->genaralSettings?->seo_keywords]);
        SEOMeta::addMeta('og:type','website');
        SEOMeta::addMeta('og:site_name',$this->genaralSettings?->site_name);
        SEOMeta::addMeta('og:image', config('app.url').'/storage/'.$this->genaralSettings?->site_logo);
        OpenGraph::setDescription($this->genaralSettings?->site_description);
        OpenGraph::setTitle($this->genaralSettings?->seo_title);
        OpenGraph::setUrl(config('app.url'));
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addImage(config('app.url').'/storage/'.$this->genaralSettings?->site_logo);
      
    }

    public function dashboard()
    {
        $this->seo();

        if (Session::has('auth_customer')) {

            $customer = Customer::where('email', Session::get('auth_customer'))->first();

            $bookings = Booking::where('customer_id', $customer?->id)->orderBy('created_at', 'desc')->paginate(10);

            return view('pages.customer.dashboard.main', compact('customer', 'bookings'));
        }


        return redirect()->route('customer.login');
    }


    public function myProfile()
    {
        $this->seo();

        $authCustomerEmail = Session::get('auth_customer');
        $customer = Customer::where('email', $authCustomerEmail)->firstOrFail();

        return view('pages.customer.dashboard.my-profile', compact('customer'));
    }


    public function myTickets(Request $request)
    {
        $this->seo();

        if ($request->id == null) {
            return redirect()->back();
        }

        return view('pages.customer.dashboard.my-tickets');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:4',
        ]);

        $authCustomerEmail = Session::get('auth_customer');
        $customer = Customer::where('email', $authCustomerEmail)->firstOrFail();
        $customer->update([
            'password' => Hash::make($request->password),
        ]);

        toastr()->success('Password Reset Successfully');

        return redirect()->route('customer.profile');
    }

    public function deleteAccount(Request $request)
    {
        $authCustomerEmail = Session::get('auth_customer');
        $customer = Customer::where('email', $authCustomerEmail)->firstOrFail();
        $customer->delete();

        Session::forget('auth_customer');

        return redirect('customer.login');
    }

    public function loginView()
    {
        $this->seo();

        return view('pages.customer.auth.login');
    }

    public function registerView()
    {
        $this->seo();

        return view('pages.customer.auth.register');
    }

    public function registerCustomer(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'email' => ['required', 'email', Rule::unique('customers', 'email')],
            'password' => 'required|string',
            'confpassword' => 'required|string|same:password',
            'region_type' => 'required|string',
            'contact_no' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        $customer = Customer::create([

            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "contact_no" => $request->contact_no,
            'password' => Hash::make($request->password),
            "region_type" => $request->region_type,
            "status" => 'active'

        ]);

        if ($customer) {

            toastr()->success('Registration Successfully!', 'Congrats');

            //$request->session()->put('auth_customer', $request->email);

            Mail::to($request->email)->send(new WelcomeEmail($request->first_name, $request->last_name));

            return redirect()->route('customer.login');
        }


        return redirect('/');
    }


    public function loginCustomer(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $customer = Customer::where('email', $request->email)->first();

        if (!$customer || !Hash::check($request->password, $customer->password)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        $request->session()->put('auth_customer', $request->email);

        if ($request->redirect != null) {
            return redirect()->back();
        }

        return redirect()->route('customer.dashboard');
    }


    public function logout()
    {
        $remove = Session::remove('auth_customer');

        if ($remove) {
            return redirect('/');
        }

        return redirect()->back();
    }
}
