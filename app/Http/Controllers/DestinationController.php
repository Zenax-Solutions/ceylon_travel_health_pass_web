<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DestinationController extends Controller
{
    public function loginView()
    {
        return view('pages.destination.auth.login');
    }

    public function loginDestination(Request $request)
    {

        $request->validate([
            'branch_code' => 'required',
        ]);

        $branch = Destination::where('branch_number', $request->branch_code)->where('status', 'publish')->first();

        if (!$branch) {
            return back()->withErrors(['branch_code' => 'Invalid Branch Code!']);
        }

        $request->session()->put('branch_code', $request->branch_code);

        return redirect()->route('destination.dashboard');
    }


    public function logout()
    {
        $remove = Session::remove('branch_code');

        if ($remove) {
            return redirect()->route('destination.login');
        }

        return redirect()->back();
    }

    public function dashboard()
    {

        if (Session::has('branch_code')) {

            $branch = Destination::where('branch_number', Session::get('branch_code'))->where('status', 'publish')->first();

            return view('pages.destination.dashboard.main', compact('branch'));
        }

        return redirect()->route('destination.login');
    }


    public function qrscan()
    {
        return view('pages.destination.pages.qrscan');
    }

    public function records()
    {
        return view('pages.destination.pages.records');
    }
}
