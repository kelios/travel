<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class SiteMapController extends Controller
{
    public function setSiteMap()
    {
        // create new sitemap object
        $sitemap = App::make("sitemap");

        // add items to the sitemap (url, date, priority, freq)
        $sitemap->add(URL::to('/'), Carbon::parse('now'), '1.0', 'daily');
        $sitemap->add(URL::to('/travels'), Carbon::parse('now'), '1.0', 'daily');
        $sitemap->add(URL::to('/about'), Carbon::parse('now'), '1.0', 'daily');

        // get all travel from db
        $travels = DB::table('travels')->where('sitemap', 1)->orderBy('created_at', 'desc')->get();

        // add every travel to the sitemap
        foreach ($travels as $travel) {
            $sitemap->add(URL::to("travels/{$travel->slug}"), $travel->updated_at, '1.0', 'weekly');
        }

        // generate your sitemap (format, filename)
        $sitemap->store('xml', 'sitemap');
        // this will generate file mysitemap.xml to your public folder
    }
}
