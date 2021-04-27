<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use App\Notifications\Feedback;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //    $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   /* public function index()
    {
        SEOMeta::setTitle(trans('home.metaMainTitle'));
        SEOMeta::setDescription(trans('home.metaMainDescription'));
        SEOMeta::setCanonical('https://metravel.by/');
        $where = ['publish' => 1, 'moderation' => 1];
        return view('welcome', ['where' => $where]);
    }*/

    public function index()
    {
        SEOMeta::setTitle(trans('home.metaMainTitle'));
        SEOMeta::setDescription(trans('home.metaMainDescription'));
        SEOMeta::setCanonical('https://metravel.by/');
        return view('map');
    }

    public function about()
    {
        SEOMeta::setTitle(trans('home.metaMainTitle'));
        SEOMeta::setDescription(trans('home.metaMainDescription'));
        SEOMeta::setCanonical('https://metravel.by/');
        $where = ['publish' => 1, 'moderation' => 1];
        return view('about', ['where' => $where]);
    }

    public function contact()
    {
        SEOMeta::setTitle(trans('home.metaMainTitle'));
        SEOMeta::setDescription(trans('home.metaMainDescription'));
        SEOMeta::setCanonical('https://metravel.by/');
        $where = ['publish' => 1, 'moderation' => 1];
        return view('feedback', ['where' => $where]);
    }

    /**
     * @param Request $request
     */
    public function feedback(Request $request)
    {
        Notification::route('mail', config('feedback.email'))
            ->notify(new Feedback($request->input()));
    }
}
