<?php

namespace App\Http\Controllers;

use App\Models\InstagramPost;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        $menServices = Service::where('gender', 'men')->get();
        $womenServices = Service::where('gender', 'women')->get();
        $instagramPosts = InstagramPost::visible()->get();
        return view('home', compact('menServices', 'womenServices', 'instagramPosts'));
    }

    public function menServices()
    {
        $services = Service::where('gender', 'men')->get();
        return view('services.men', compact('services'));
    }

    public function womenServices()
    {
        $services = Service::where('gender', 'women')->get();
        return view('services.women', compact('services'));
    }
}
