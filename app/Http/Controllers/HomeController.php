<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Destination;
use App\Models\DiscountService;
use App\Models\DiscountShop;
use App\Models\Package;
use App\Models\Review;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Joaopaulolndev\FilamentGeneralSettings\Models\GeneralSetting;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    private $genaralSettings;

    public function __construct()
    {
        $this->genaralSettings = GeneralSetting::first();
    }

    //seo function
    public function seo()
    {

        SEOMeta::setTitle($this->genaralSettings?->site_name);
        SEOMeta::setDescription($this->genaralSettings?->site_description);
        SEOMeta::addMeta('article:section', $this->genaralSettings?->seo_title, 'property');
        SEOMeta::addKeyword([$this->genaralSettings?->seo_keywords]);
        SEOMeta::addMeta('og:type', 'website');
        SEOMeta::addMeta('og:site_name', $this->genaralSettings?->site_name);
        SEOMeta::addMeta('og:image', env('APP_URL') . '/storage/' . $this->genaralSettings?->site_logo);
        OpenGraph::setDescription($this->genaralSettings?->site_description);
        OpenGraph::setTitle($this->genaralSettings?->seo_title);
        OpenGraph::setUrl(env('APP_URL'));
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addImage(env('APP_URL') . '/storage/' . $this->genaralSettings?->site_logo);
    }

    public function home()
    {

        $this->seo();

        $packages = Package::where('show_tour_agent_only', false)->get();

        $destinations = Destination::all();

        // Get published discount shops and shuffle them, then take 3
        $discountShops = DiscountShop::where('status', 'publish')->get()->shuffle()->take(3);

        // Get published discount services and shuffle them, then take 3
        $discountServices = DiscountService::where('status', 'publish')->get()->shuffle()->take(3);

        // Get published blogs and shuffle them, then take 3
        $blogs = Blog::where('is_published', true)->get()->shuffle()->take(3);

        // Get published reviews.
        $reviews = Review::where('is_published', true)->get();

        return view('pages.home.welcome', compact('packages', 'destinations', 'discountShops', 'discountServices', 'blogs', 'reviews'));
    }

    public function package(Request $request)
    {
        $this->seo();

        $package = Package::find($request->id);

        if ($package == null) {
            return redirect('/');
        }

        return view('pages.home.package');
    }


    public function shops()
    {

        $this->seo();

        OpenGraph::setTitle('Shops');

        $discountShops = DiscountShop::where('status', 'publish')->get();

        return view('pages.home.pages.shops', compact('discountShops'));
    }

    public function services()
    {
        $this->seo();

        OpenGraph::setTitle('Services');

        $discountServices = DiscountService::where('status', 'publish')->get();

        return view('pages.home.pages.services', compact('discountServices'));
    }

    public function blogs()
    {
        $this->seo();

        OpenGraph::setTitle('Blogs');

        $blogs = Blog::all()->where('is_published', true);

        return view('pages.home.pages.blogs', compact('blogs'));
    }

    public function singleBlog(Request $request)
    {

        $blog = Blog::where('slug', $request->slug)->first();

        if ($blog == null) {
            redirect()->back();
        }

        $this->seo();

        SEOMeta::setTitle($blog?->title);
        SEOMeta::setDescription($blog?->seo_description);
        SEOMeta::addKeyword([$blog?->seo_keywords]);
        SEOMeta::addMeta('og:type', 'article');
        SEOMeta::addMeta('og:image', Storage::url($blog?->image));

        OpenGraph::setTitle($blog?->title);


        return view('pages.home.pages.blog-page', compact('blog'));
    }


    public function review()
    {
        $this->seo();

        OpenGraph::setTitle('Review');

        return view('pages.home.pages.review');
    }


    public function thankYouPage()
    {
        $this->seo();

        return view('pages.home.pages.thank-you-page');
    }
}
