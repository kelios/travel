<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        SEOMeta::setTitle('MeTravel - Travels');
        SEOMeta::setDescription('Travels');
        SEOMeta::setCanonical('https://metravel.by/');
        return view('welcome');
    }

    public function about()
    {
        SEOMeta::setTitle('MeTravel - Travels');
        SEOMeta::setDescription('Travels');
        SEOMeta::setCanonical('https://metravel.by/');
        return view('about');
    }

    public function feedback()
    {
        SEOMeta::setTitle('MeTravel - Travels');
        SEOMeta::setDescription('Travels');
        SEOMeta::setCanonical('https://metravel.by/');
        return view('feedback');
    }
}
