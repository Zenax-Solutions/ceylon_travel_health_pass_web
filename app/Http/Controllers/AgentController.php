<?php

namespace App\Http\Controllers;

use App\Mail\AgentWelcomeEmail;
use App\Models\Agent;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AgentController extends Controller
{
    public function dashboard()
    {
        if (Session::has('auth_agent')) {

            $agent = Agent::where('email', Session::get('auth_agent'))->first();

            $bookings = Booking::where('agent_id', $agent?->id)->paginate(10);

            return view('pages.agent.dashboard.main', compact('agent', 'bookings'));
        }

        return redirect()->route('agent.login');
    }

    public function loginView()
    {
        return view('pages.agent.auth.login');
    }

    public function registerView()
    {
        return view('pages.agent.auth.register');
    }


    public function registerAgent(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'name' => 'required|string',
            'email' => ['required', 'email', Rule::unique('agents', 'email')],
            'password' => 'required|string',
            'confirm_password' => 'required|string|same:password',
            'contact_no' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10',
            'id_no' => 'required|string',
        ]);


        $coupon_code =  null;

        if ($request->type == 'tour_agent') {
            $coupon_code = $this->generateUniqueCouponCode();
        }


        $agent = Agent::create([

            'type' => $request->type,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact_no' => $request->contact_no,
            'id_no' => $request->id_no,
            'license_no' => $request->license_no,
            'coupon_code' => $coupon_code,
            "status" => 'pending'

        ]);

        if ($agent) {

            toastr()->success('Registration Successfully!', 'Congrats');

            //$request->session()->put('auth_agent', $request->email);

            Mail::to($request->email)->send(new AgentWelcomeEmail($request->name));

            return redirect()->route('agent.login');
        }


        return redirect('/');
    }


    public function loginAgent(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $agent = Agent::where('email', $request->email)->first();

        if (!$agent || !Hash::check($request->password, $agent->password)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        $request->session()->put('auth_agent', $request->email);

        return redirect()->route('agent.dashboard');
    }


    public function qrscan()
    {
        return view('pages.agent.dashboard.pages.qrscan');
    }

    public function records()
    {
        return view('pages.agent.dashboard.pages.records');
    }

    public function services()
    {
        return view('pages.agent.dashboard.pages.services');
    }

    public function packages()
    {

        $authAgentEmail = Session::get('auth_agent');
        $agent = Agent::where('email', $authAgentEmail)->firstOrFail();

        if ($agent->type != 'tour_agent' || $agent->status == 'pending') {
            return redirect()->route('agent.dashboard');
        }

        $packages = Package::all();

        return view('pages.agent.dashboard.pages.agent-packages', compact('packages', 'agent'));
    }

    public function booking(Request $request)
    {
        $authAgentEmail = Session::get('auth_agent');
        $agent = Agent::where('email', $authAgentEmail)->firstOrFail();

        if ($agent->type != 'tour_agent' || $agent->status == 'pending') {
            return redirect()->route('agent.dashboard');
        }

        $package = Package::find($request->id);

        if ($package == null) {
            return redirect()->route('agent.packages');
        }

        return view('pages.agent.dashboard.pages.agent-booking');
    }

    public function myProfile()
    {
        $authAgentEmail = Session::get('auth_agent');
        $agent = Agent::where('email', $authAgentEmail)->firstOrFail();

        if ($agent->status == 'pending') {
            return redirect()->route('agent.dashboard');
        }

        return view('pages.agent.dashboard.pages.agent-profile', compact('agent'));
    }

    public function myTickets(Request $request)
    {
        if ($request->id == null) {
            return redirect()->back();
        }

        return view('pages.agent.dashboard.pages.my-tickets');
    }


    public function imageUpdate(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $authAgentEmail = Session::get('auth_agent');
        $agent = Agent::where('email', $authAgentEmail)->firstOrFail();

        // Handle the upload and save
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('', $imageName, 'public');

            // Delete old image if exists
            if ($agent->profile_image) {
                Storage::disk('public')->delete($agent->profile_image);
            }

            $agent->update([
                'profile_image' => $imagePath,
            ]);

            toastr()->success('Profile Image Updated Successfully');
        }

        return redirect()->back();
    }


    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:4',
        ]);

        $authAgentEmail = Session::get('auth_agent');
        $agent = Agent::where('email', $authAgentEmail)->firstOrFail();
        $agent->update([
            'password' => Hash::make($request->password),
        ]);

        toastr()->success('Password Reset Successfully');

        return redirect()->route('agent.profile');
    }


    public function logout()
    {
        $remove = Session::remove('auth_agent');

        Session::remove('selection');

        if ($remove) {
            return redirect()->route('agent.login');
        }

        return redirect()->back();
    }



    //genrate uniqe coupon code

    public function generateUniqueCouponCode()
    {
        $characters = env('COUPON_CHARACTERS', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
        $length = env('COUPON_LENGTH', 5);
        $code = '';

        do {
            $code = '';
            for ($i = 0; $i < $length; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $code .= $characters[$index];
            }
        } while (Agent::where('coupon_code', $code)->exists());

        return $code;
    }
}
