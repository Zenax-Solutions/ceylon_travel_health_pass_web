<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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


    public function logout()
    {
        $remove = Session::remove('auth_agent');

        Session::remove('selection');

        if ($remove) {
            return redirect()->route('agent.login');
        }

        return redirect()->back();
    }


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
