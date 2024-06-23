<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Hero;
use App\Models\Service;
use App\Models\TyperTitle;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        // Query all data needed and just pass it here
        $hero = Hero::first();
        $typertitles = TyperTitle::all();
        $services = Service::all();
        $about = About::first();

        return view('frontend.home', compact('hero', 'typertitles', 'services', 'about'));
    }
}
