<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\DiscountService;
use App\Models\DiscountShop;
use App\Models\Package;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $packages = Package::where('show_tour_agent_only', false)->get();

        $destinations = Destination::all();

        // Get published discount shops and shuffle them, then take 3
        $discountShops = DiscountShop::where('status', 'publish')->get()->shuffle()->take(3);

        // Get published discount services and shuffle them, then take 3
        $discountServices = DiscountService::where('status', 'publish')->get()->shuffle()->take(3);

        return view('pages.home.welcome', compact('packages', 'destinations', 'discountShops', 'discountServices'));
    }

    public function package(Request $request)
    {
        $package = Package::find($request->id);

        if ($package == null) {
            return redirect('/');
        }

        return view('pages.home.package');
    }


    public function shops()
    {
        $discountShops = DiscountShop::where('status', 'publish')->get();

        return view('pages.home.pages.shops', compact('discountShops'));
    }

    public function services()
    {
        $discountServices = DiscountService::where('status', 'publish')->get();

        return view('pages.home.pages.services', compact('discountServices'));
    }

    public function thankYouPage()
    {
        return view('pages.home.pages.thank-you-page');
    }
}
